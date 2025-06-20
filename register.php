<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $age      = $_POST['age'];
    $weight   = $_POST['weight'];
    $role     = $_POST['role'];  // new line

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'trainer') {
        // Check if trainer email exists
        $check = $conn->prepare("SELECT * FROM trainer WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            echo "<script>alert('Trainer email already registered. Please log in.'); window.location='login.html';</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO trainer (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Trainer registered! Please log in.'); window.location='login.html';</script>";
            } else {
                echo "<script>alert('Trainer registration failed.'); window.history.back();</script>";
            }

            $stmt->close();
        }

    } else { // MEMBER registration
        $check = $conn->prepare("SELECT * FROM member WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            echo "<script>alert('Member email already registered.'); window.location='login.html';</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO member (name, email, password, age, weight) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssdi", $name, $email, $hashed_password, $age, $weight);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful! Please log in.'); window.location='login.html';</script>";
            } else {
                echo "<script>alert('Member registration failed.'); window.history.back();</script>";
            }

            $stmt->close();
        }
    }

    $check->close();
    $conn->close();
} else {
    header("Location: register.html");
    exit();
}
?>
