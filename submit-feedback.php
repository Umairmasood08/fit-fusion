<?php
// submit-feedback.php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'member') {
  header("Location: login.html");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $member_id = $_SESSION['id'];
  $feedback = trim($_POST['feedback']);

  $stmt = $conn->prepare("INSERT INTO feedback (member_id, message, submitted_at) VALUES (?, ?, NOW())");
  $stmt->bind_param("is", $member_id, $feedback);

  if ($stmt->execute()) {
    echo "<script>alert('Thank you for your feedback!'); window.location.href='member-dashboard.php';</script>";
  } else {
    echo "<script>alert('Error submitting feedback.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
} else {
  header("Location: feedback.html");
  exit();
}
