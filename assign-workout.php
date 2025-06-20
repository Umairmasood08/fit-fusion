<?php
// assign-workout.php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'trainer') {
  header("Location: login.html");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $member_id = intval($_POST['member_id']);
  $workout = trim($_POST['workout']);
  $trainer_id = $_SESSION['id'];

  $stmt = $conn->prepare("INSERT INTO workout_plan (member_id, description, assigned_date) VALUES (?, ?, CURDATE())");
  $stmt->bind_param("is", $member_id, $workout);

  if ($stmt->execute()) {
    header("Location: trainer-dashboard.php");
  } else {
    echo "Error saving workout plan.";
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: trainer-dashboard.php");
  exit();
}
