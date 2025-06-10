<?php
// Include your database connection
include('db.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_url = $_POST['product_url'];
    $product_message = $_POST['product_message'];
    $off_percentage = $_POST['off_percentage'];
    $mrp_price = $_POST['mrp_price'];
    $sell_price = $_POST['sell_price'];
    $delivery_msg = $_POST['delivery_msg'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];
    $total_ratings = $_POST['total_ratings'];
    $slider_images = $_POST['slider_images'];
    $color_options = $_POST['color_options'];
    $storage_options = $_POST['storage_options'];
    $company_name = $_POST['company_name'];

    // Ensure slider_images and color_options are either JSON or NULL
    $slider_images = !empty($slider_images) ? json_encode($slider_images) : NULL;
    $color_options = !empty($color_options) ? json_encode($color_options) : NULL;

    // Update query
    $query = "UPDATE products SET product_name = ?, product_image = ?, product_url = ?, product_message = ?, off_percentage = ?, mrp_price = ?, sell_price = ?, delivery_msg = ?, rating = ?, category = ?, total_ratings = ?, slider_images = ?, color_options = ?, storage_options = ?, company_name = ? WHERE id = ?";
    
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("ssssdiidsssssss", 
        $product_name, 
        $product_image, 
        $product_url, 
        $product_message, 
        $off_percentage, 
        $mrp_price, 
        $sell_price, 
        $delivery_msg, 
        $rating, 
        $category, 
        $total_ratings, 
        $slider_images, 
        $color_options, 
        $storage_options, 
        $company_name, 
        $id
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>