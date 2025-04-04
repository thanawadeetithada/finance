<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO expenses (date, type, category, amount) VALUES (:date, :type, :category, :amount)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':amount', $amount);
    
    if ($stmt->execute()) {
        echo "<script>window.location = 'index.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'index.php';</script>";
    }
}
?>
