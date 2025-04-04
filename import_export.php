<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['import_file'])) {
    $file = $_FILES['import_file']['tmp_name'];
    
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    foreach ($rows as $index => $row) {
        if ($index == 0) continue;
        
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

    echo "<script>window.location = 'index.php';</script>";
}
?>

<form action="import_export.php" method="POST" enctype="multipart/form-data" class="import-form">
    <div class="mb-3">
        <label for="import_file" class="form-label">เลือกไฟล์ที่ต้องการนำเข้า</label>
        <input type="file" name="import_file" id="import_file" class="form-control" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">นำเข้าข้อมูล</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php';">ยกเลิก</button>
    </div>
</form>

<style>
    .import-form {
        padding: 1rem;
        border-radius: 8px;
        background-color: #ffffff;
    }

    .import-form .form-label {
        font-weight: bold;
    }

    .import-form input[type="file"] {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .import-form button {
        font-size: 16px;
        padding: 0.5rem 2rem;
    }

    .import-form .text-end {
        margin-top: 1rem;
    }

    .import-form button:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .modal-content {
        padding: 2rem;
    }
</style>
