<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once 'db.php';

$sql = "SELECT date, type, category, amount FROM expenses ORDER BY date DESC";
$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'วันที่');
$sheet->setCellValue('B1', 'ประเภท');
$sheet->setCellValue('C1', 'หมวดหมู่');
$sheet->setCellValue('D1', 'จำนวนเงิน');

$row = 2;
foreach ($entries as $entry) {
    $sheet->setCellValue('A' . $row, $entry['date']);
    $sheet->setCellValue('B' . $row, $entry['type']);
    $sheet->setCellValue('C' . $row, $entry['category']);
    $sheet->setCellValue('D' . $row, number_format($entry['amount'], 2));
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'expense_report.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit();
?>
