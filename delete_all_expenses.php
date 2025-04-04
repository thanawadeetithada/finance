<?php
require_once 'db.php';

$sql = "DELETE FROM expenses";
$stmt = $pdo->prepare($sql);

if ($stmt->execute()) {
    echo "Data deleted successfully";
} else {
    echo "Error deleting data";
}
?>
