<?php
include 'db.php'; // Include database connection file

// Initialize messages
$success_message = '';
$error_message = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get form data
    $category = $_POST['category'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $product_image = $_POST['product_image'] ?? '';
    $product_message = $_POST['product_message'] ?? '';
    $sell_price = $_POST['sell_price'] ?? 0;
    $mrp_price = $_POST['mrp_price'] ?? 0;
    $delivery_msg = $_POST['delivery_msg'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $total_ratings = $_POST['total_ratings'] ?? 0;

    // Generate a unique product URL
    $product_url = md5(uniqid($product_name, true));

    // Calculate discount percentage
    $off_percentage = ($mrp_price > 0) ? (($mrp_price - $sell_price) / $mrp_price) * 100 : 0;

    // Validate required fields
    if ($category && $product_name && $product_image && $sell_price > 0 && $mrp_price > 0) {
        // Insert product into the database
        $query = "INSERT INTO products (
            category,
            product_name,
            product_image,
            product_message,
            sell_price,
            mrp_price,
            off_percentage,
            delivery_msg,
            rating,
            total_ratings,
            product_url
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(
            'sssdddsssis',
            $category,
            $product_name,
            $product_image,
            $product_message,
            $sell_price,
            $mrp_price,
            $off_percentage,
            $delivery_msg,
            $rating,
            $total_ratings,
            $product_url
        );

        if ($stmt->execute()) {
            // Redirect to avoid resubmission
            header('Location: ' . $_SERVER['PHP_SELF'] . '?success=1&url=' . $product_url);
            exit;
        } else {
            $error_message = "Error adding product: " . $stmt->error;
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}

// Check for success message in the URL query string
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Product added successfully! Product URL: " . htmlspecialchars($_GET['url']);
}
?>
<?php include 'header.php';?>

    <title>Add Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        
        .container {
            
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            grid-column: span 2;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }
            button {
                grid-column: span 1;
            }
        }
    </style>

<br><br>

<div class="container">
    <h2>Add New Product</h2>

    <?php if ($success_message): ?>
        <div class="message success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <?php if ($error_message): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="mobiles">Mobiles</option>
                <option value="home-and-kitchen">Home and Kitchen</option>
                <option value="tv-appliances">TV and Appliances</option>
                <option value="smart-gadget">Smart Gadgets</option>
                <option value="beauty-toys-sports">Beauty, Toys & Sports</option>
                <option value="electronics-accesories">Electronics Accessories</option>
                <option value="aristocrat">Aristocrat</option>
                <option value="women-fashion">Women Fashion</option>
                <option value="men-fashion">Men Fashion</option>
                <option value="footware">Footware</option>
                <option value="others" selected>Others</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>

        <div class="form-group">
            <label for="product_image">Product Image URL</label>
            <input type="url" id="product_image" name="product_image" required>
        </div>

        <div class="form-group">
            <label for="product_message">Product Message</label>
            <select id="product_message" name="product_message">
                <option value="Last 1 left">Last 1 left</option>
                <option value="Last 3 left">Last 3 left</option>
                <option value="Only Few left">Only Few left</option>
                <option value="Lowest Price in 30 days">Lowest Price in 30 days</option>
                <option value="Bank Offer" selected>Bank Offer</option>
                <option value="Top Discount of the Sale">Top Discount of the Sale</option>
                <option value="Hot Deal">Hot Deal</option>
                <option value="Limited Time Deal">Limited Time Deal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="sell_price">Sell Price</label>
            <input type="number" id="sell_price" name="sell_price" required step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="mrp_price">MRP Price</label>
            <input type="number" id="mrp_price" name="mrp_price" required step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="delivery_msg">Delivery Message</label>
            <select id="delivery_msg" name="delivery_msg">
                <option value="Free delivery" selected>Free delivery</option>
                <option value="Free delivery by Tomorrow">Free delivery by Tomorrow</option>
                <option value="Free delivery by 2 days">Free delivery by 2 days</option>
                <option value="Free delivery by 3 days">Free delivery by 3 days</option>
                <option value="Free delivery by 4 days">Free delivery by 4 days</option>
                <option value="Free delivery by 5 days">Free delivery by 5 days</option>
                <option value="Free delivery by 6 days">Free delivery by 6 days</option>
            </select>
        </div>

        <div class="form-group">
            <label for="rating">Rating</label>
            <select id="rating" name="rating">
                <option value="rating1.svg">1 Star</option>
                <option value="rating2.svg">2 Stars</option>
                <option value="rating3.svg">3 Stars</option>
                <option value="rating4.svg">4 Stars</option>
                <option value="rating5.svg" selected>5 Stars</option>
            </select>
        </div>

        <div class="form-group">
            <label for="total_ratings">Total Ratings</label>
            <input type="number" id="total_ratings" name="total_ratings" required min="0">
        </div>

        <button type="submit" name="submit">Add Product</button>
    </form>
</div>

</body>
</html>
