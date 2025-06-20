<?php
// trainer-dashboard.php
require 'db.php';
session_start();

// Check login & role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'trainer') {
  header("Location: login.html");
  exit();
}

$trainer_id = $_SESSION['id'];

// ✅ Step 1: Handle "Assign to Me" form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_member_id'])) {
    $assign_id = (int)$_POST['assign_member_id'];
    $assign_stmt = $conn->prepare("UPDATE member SET trainer_id = ? WHERE member_id = ?");
    $assign_stmt->bind_param("ii", $trainer_id, $assign_id);
    $assign_stmt->execute();
    $assign_stmt->close();
}

// ✅ Step 2: Fetch assigned members
$stmt = $conn->prepare("SELECT member_id, name, email, age, weight FROM member WHERE trainer_id = ?");
$stmt->bind_param("i", $trainer_id);
$stmt->execute();
$members = $stmt->get_result();
$stmt->close();

// ✅ Step 3: Fetch unassigned members
$unassigned_stmt = $conn->prepare("SELECT member_id, name, email, age, weight FROM member WHERE trainer_id IS NULL");
$unassigned_stmt->execute();
$unassigned_members = $unassigned_stmt->get_result();
$unassigned_stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trainer Dashboard</title>
  <style>
    body { background: #0f0f0f; color: #fff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 0; }
    header { background: #1f1f1f; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    .logo { color: #b6ff4c; font-size: 1.5rem; font-weight: bold; }
    h2 { text-align: center; color: #b6ff4c; margin: 2rem 0 1rem; }
    .member-list { max-width: 1000px; margin: auto; padding: 2rem; }
    table { width: 100%; border-collapse: collapse; background: #1f1f1f; }
    th, td { padding: 1rem; text-align: left; color: #ccc; border-bottom: 1px solid #333; vertical-align: top; }
    th { background: #2a2a2a; color: #b6ff4c; }
    textarea, input[type="datetime-local"] {
      width: 100%; background: #2a2a2a; color: #fff; border: none;
      padding: 0.5rem; border-radius: 6px;
    }
    button {
      margin-top: 0.5rem; background: #b6ff4c; color: #000;
      padding: 0.5rem 1rem; border: none; border-radius: 6px; cursor: pointer;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">Trainer Dashboard</div>
    <div><a href="logout.php" style="color:#fff; text-decoration:none;">Logout</a></div>
  </header>

  <h2>Your Assigned Members</h2>
  <div class="member-list">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Age</th>
          <th>Weight</th>
          <th>Assign Diet</th>
          <th>Assign Workout</th>
          <th>Assign Session</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($members->num_rows === 0): ?>
          <tr><td colspan="7">No members assigned yet.</td></tr>
        <?php else: ?>
          <?php while ($row = $members->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['age']) ?></td>
              <td><?= htmlspecialchars($row['weight']) ?> kg</td>
              <td>
                <form method="post" action="assign-nutrition.php">
                  <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                  <textarea name="nutrition" rows="2" required></textarea>
                  <button type="submit">Save</button>
                </form>
              </td>
              <td>
                <form method="post" action="assign-workout.php">
                  <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                  <textarea name="workout" rows="2" required></textarea>
                  <button type="submit">Save</button>
                </form>
              </td>
              <td>
                <form method="post" action="assign-session.php">
                  <input type="hidden" name="member_id" value="<?= $row['member_id'] ?>">
                  <input type="datetime-local" name="session_time" required>
                  <button type="submit">Assign</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if ($unassigned_members->num_rows > 0): ?>
  <h2>Unassigned Members</h2>
  <div class="member-list">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Age</th>
          <th>Weight</th>
          <th>Assign</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $unassigned_members->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['age']) ?></td>
            <td><?= htmlspecialchars($row['weight']) ?> kg</td>
            <td>
              <form method="POST">
                <input type="hidden" name="assign_member_id" value="<?= $row['member_id'] ?>">
                <button type="submit">Assign to Me</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
<?php else: ?>
  <h2 style="text-align:center; margin-top:2rem;">No unassigned members available.</h2>
<?php endif; ?>

</body>
</html>
