<?php
session_start();
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Expense Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 2rem;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row mb-4">
        <div class="col text-center">
            <h1>📊 โปรแกรมบันทึกรายรับรายจ่าย</h1>
            <p class="text-muted">ใช้งานง่าย ครบ จบในที่เดียว</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>➕ เพิ่มรายรับ/รายจ่าย</h5>
                <form action="add_entry.php" method="POST">
                    <div class="mb-2">
                        <label for="date" class="form-label">วันที่</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="mb-2">
                        <label for="type" class="form-label">ประเภท</label>
                        <select class="form-control" name="type" required>
                            <option value="income">รายรับ</option>
                            <option value="expense">รายจ่าย</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="category" class="form-label">หมวดหมู่</label>
                        <select class="form-control" name="category" required>
                            <option value="อาหาร">อาหาร</option>
                            <option value="เดินทาง">เดินทาง</option>
                            <option value="บันเทิง">บันเทิง</option>
                            <option value="อื่น ๆ">อื่น ๆ</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="amount" class="form-label">จำนวนเงิน</label>
                        <input type="number" step="0.01" class="form-control" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">บันทึก</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h5>📅 รายการประจำเดือน</h5>
                <div id="monthly-summary">
                  
                </div>
                <div class="mt-3 text-end">
                    <a href="report_export.php" class="btn btn-success">📤 Export รายงาน Excel</a>
             
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#importModal">
                        🔄 นำเข้าข้อมูล
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">นำเข้าข้อมูล</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="import-form">
          <!-- ฟอร์มจะโหลดจากไฟล์ import_export.php -->
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('#monthly-summary').load('monthly_summary.php');

        $('#importModal').on('show.bs.modal', function () {
            $('#import-form').load('import_export.php');
        });
    });
</script>

</body>
</html>
