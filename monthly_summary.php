<?php
require_once 'db.php';

$sql = "SELECT date, type, category, amount FROM expenses ORDER BY date DESC";
$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalIncome = 0;
$totalExpense = 0;

foreach ($entries as $entry) {
    if ($entry['type'] == 'income') {
        $totalIncome += $entry['amount'];
    } else {
        $totalExpense += $entry['amount'];
    }
}

$balance = $totalIncome - $totalExpense;

echo "<p><strong>รายรับทั้งหมด:</strong> " . number_format($totalIncome, 2) . " บาท</p>";
echo "<p><strong>รายจ่ายทั้งหมด:</strong> " . number_format($totalExpense, 2) . " บาท</p>";
echo "<p><strong>ยอดคงเหลือ:</strong> " . number_format($balance, 2) . " บาท</p>";
?>
