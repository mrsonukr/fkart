<?php
include 'db.php'; // Your DB connection file

// Get product ID and new status from the URL
$productId = $_GET['id'] ?? null;
$status = $_GET['status'] ?? null;

if ($productId && in_array($status, ['pin', 'hide', 'default'])) {
    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE products SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $status, $productId);
    if ($stmt->execute()) {
        // Redirect back to the product list
        header("Location: view.php");
        exit;
    } else {
        echo "Error updating status.";
    }
} else {
    echo "Invalid parameters.";
}
?>
