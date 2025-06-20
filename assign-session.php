<?php
// assign-session.php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'trainer') {
  header("Location: login.html");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $member_id = intval($_POST['member_id']);
  $datetime = $_POST['session_time'];
  $trainer_id = $_SESSION['id'];

  // Insert session into class table
  $stmt = $conn->prepare("INSERT INTO class (name, schedule, trainer_id) VALUES (?, ?, ?)");
  $session_title = "Custom Session - $member_id";
  $stmt->bind_param("ssi", $session_title, $datetime, $trainer_id);

  if ($stmt->execute()) {
    $class_id = $stmt->insert_id;

    // Assign attendance to member
    $assign = $conn->prepare("INSERT INTO attendance (member_id, class_id, attended) VALUES (?, ?, false)");
    $assign->bind_param("ii", $member_id, $class_id);
    $assign->execute();
    $assign->close();

    header("Location: trainer-dashboard.php");
  } else {
    echo "Error assigning session.";
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: trainer-dashboard.php");
  exit();
}
