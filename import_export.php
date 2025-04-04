<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['import_file'])) {
    $file = $_FILES['import_file']['tmp_name'];
    
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    foreach ($rows as $row) {
        $date = $row[0];
        $type = $row[1];
        $category = $row[2];
        $amount = $row[3];
        if (!empty($date) && !empty($type) && !empty($category) && !empty($amount)) {
            $sql = "INSERT INTO expenses (date, type, category, amount) VALUES (:date, :type, :category, :amount)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':amount', $amount);
            $stmt->execute();
        }
    }

    echo "<script>alert('นำเข้าข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
}
?>

<form action="import_export.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="import_file" required>
    <button type="submit" class="btn btn-primary">นำเข้าข้อมูล</button>
</form>
