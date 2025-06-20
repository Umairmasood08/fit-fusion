<?php
// login.php - handles both trainer and member login
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role === 'trainer') {
        $stmt = $conn->prepare("SELECT trainer_id, name, password FROM trainer WHERE email = ?");
    } else {
        $stmt = $conn->prepare("SELECT member_id, name, password FROM member WHERE email = ?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['id'] = ($role === 'trainer') ? $user['trainer_id'] : $user['member_id'];

            if ($role === 'trainer') {
                
                header("Location: trainer-dashboard.php");
            } else {
                header("Location: member-dashboard.php");
            }
            exit();
        }
    }

    echo "<script>alert('Invalid email or password.'); window.history.back();</script>";
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>
