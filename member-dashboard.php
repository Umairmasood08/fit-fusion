<?php
// member-dashboard.php
require 'db.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'member') {
  header("Location: login.html");
  exit();
}

$member_id = $_SESSION['id'];

// Fetch latest nutrition plan
$nutrition_sql = "SELECT description, assigned_date FROM nutrition_plan WHERE member_id = ? ORDER BY assigned_date DESC LIMIT 1";
$n_stmt = $conn->prepare($nutrition_sql);
$n_stmt->bind_param("i", $member_id);
$n_stmt->execute();
$nutrition = $n_stmt->get_result()->fetch_assoc();

// Fetch latest workout plan
$workout_sql = "SELECT description, assigned_date FROM workout_plan WHERE member_id = ? ORDER BY assigned_date DESC LIMIT 1";
$w_stmt = $conn->prepare($workout_sql);
$w_stmt->bind_param("i", $member_id);
$w_stmt->execute();
$workout = $w_stmt->get_result()->fetch_assoc();

// Fetch upcoming session
$session_sql = "
  SELECT c.name, c.schedule FROM class c
  JOIN attendance a ON a.class_id = c.class_id
  WHERE a.member_id = ? AND c.schedule >= NOW()
  ORDER BY c.schedule ASC LIMIT 1";
$s_stmt = $conn->prepare($session_sql);
$s_stmt->bind_param("i", $member_id);
$s_stmt->execute();
$session_info = $s_stmt->get_result()->fetch_assoc();

// Fetch payment history
$payments_sql = "SELECT amount, method, payment_date, status FROM payment WHERE member_id = ? ORDER BY payment_date DESC";
$p_stmt = $conn->prepare($payments_sql);
$p_stmt->bind_param("i", $member_id);
$p_stmt->execute();
$payments = $p_stmt->get_result();
?>
<header>
  <div class="logo">FITfusion</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="member-dashboard.php#diet">Diet Plan</a>
    <a href="member-dashboard.php#session">Sessions</a>
    <a href="payments.html">Fees</a>
    <a href="feedback.html">Feedback</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Member Dashboard</title>
  <style>
    header {
  background: #1f1f1f;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.logo {
  color: #b6ff4c;
  font-size: 1.5rem;
  font-weight: bold;
}
nav a {
  color: white;
  text-decoration: none;
  margin: 0 1rem;
  font-weight: 500;
  transition: color 0.3s ease;
}
nav a:hover {
  color: #b6ff4c;
}

    body { background: #0f0f0f; color: #fff; font-family: 'Segoe UI', sans-serif; padding: 2rem; }
    h2 { color: #b6ff4c; }
    section { background: #1f1f1f; padding: 1rem; border-radius: 10px; margin-bottom: 2rem; }
    table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    th, td { padding: 0.75rem; border-bottom: 1px solid #333; text-align: left; color: #ccc; }
    th { background-color: #2a2a2a; color: #b6ff4c; }
  </style>
</head>
<body>
  <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>

  <section>
    <h3>Nutrition Plan</h3>
    <?php if ($nutrition): ?>
      <p><strong>Date:</strong> <?= $nutrition['assigned_date'] ?></p>
      <p><?= nl2br(htmlspecialchars($nutrition['description'])) ?></p>
    <?php else: ?>
      <p>No nutrition plan assigned yet.</p>
    <?php endif; ?>
  </section>

  <section>
    <h3>Workout Plan</h3>
    <?php if ($workout): ?>
      <p><strong>Date:</strong> <?= $workout['assigned_date'] ?></p>
      <p><?= nl2br(htmlspecialchars($workout['description'])) ?></p>
    <?php else: ?>
      <p>No workout plan assigned yet.</p>
    <?php endif; ?>
  </section>

  <section>
    <h3>Upcoming Session</h3>
    <?php if ($session_info): ?>
      <p><strong>Session:</strong> <?= htmlspecialchars($session_info['name']) ?></p>
      <p><strong>Time:</strong> <?= $session_info['schedule'] ?></p>
    <?php else: ?>
      <p>No upcoming session assigned.</p>
    <?php endif; ?>
  </section>

  <section>
    <h3>Payment History</h3>
    <?php if ($payments->num_rows > 0): ?>
      <table>
        <tr><th>Date</th><th>Amount</th><th>Method</th><th>Status</th></tr>
        <?php while ($row = $payments->fetch_assoc()): ?>
          <tr>
            <td><?= $row['payment_date'] ?></td>
            <td>$<?= $row['amount'] ?></td>
            <td><?= $row['method'] ?></td>
            <td><?= $row['status'] ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>No payment records found.</p>
    <?php endif; ?>
  </section>
</body>
</html>
