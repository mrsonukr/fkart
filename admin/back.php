<?php
include 'db.php';

// Get Product ID
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Product ID is required.");
}

// Fetch product details
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Fetch slider images and color options
$slider_images = json_decode($product['slider_images'], true) ?? [];
$colors = json_decode($product['color_options'], true) ?? [];

// Initialize success and error messages
$success_message = "";
$error_message = "";

// Handle Edit Product Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $product_name = $_POST['product_name'] ?? '';
    $product_image = $_POST['product_image'] ?? '';
    $product_message = $_POST['product_message'] ?? '';
    $mrp_price = $_POST['mrp_price'] ?? 0;
    $sell_price = $_POST['sell_price'] ?? 0;
    $delivery_msg = $_POST['delivery_msg'] ?? '';
    $category = $_POST['category'] ?? '';
    $storage_options = $_POST['storage_options'] ?? '';
    $ram = $_POST['ram'] ?? '';

    if ($product_name && $product_image && $mrp_price > 0 && $sell_price > 0 && $category) {
        $off_percentage = ($mrp_price - $sell_price) / $mrp_price * 100;

        $update_query = "UPDATE products SET 
            product_name = ?, 
            product_image = ?, 
            product_message = ?, 
            mrp_price = ?, 
            sell_price = ?, 
            delivery_msg = ?, 
            category = ?, 
            storage_options = ?, 
            ram = ?, 
            off_percentage = ? 
            WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('sssddsssddi', $product_name, $product_image, $product_message, $mrp_price, $sell_price, $delivery_msg, $category, $storage_options, $ram, $off_percentage, $id);

        if ($stmt->execute()) {
            $success_message = "Product updated successfully!";
        } else {
            $error_message = "Error updating product: " . $stmt->error;
        }
    } else {
        $error_message = "All required fields must be filled!";
    }
}

// Handle Add Slider Image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_slider') {
    $image = $_POST['value'] ?? '';
    if ($image && !in_array($image, $slider_images)) {
        $slider_images[] = $image;
        $update_query = "UPDATE products SET slider_images = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode($slider_images), $id);
        $stmt->execute();
        $success_message = "Slider image added successfully!";
    }
}
// Handle Delete Slider Image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_slider') {
    $image = $_POST['value'] ?? '';
    if ($image && in_array($image, $slider_images)) {
        $slider_images = array_diff($slider_images, [$image]);
        $update_query = "UPDATE products SET slider_images = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode(array_values($slider_images)), $id);
        $stmt->execute();
        $success_message = "Slider image deleted successfully!";
    }
}

// Handle Add Color
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_color'])) {
    $color_name = $_POST['color_name'] ?? '';
    $color_image = $_POST['color_image'] ?? '';
    if ($color_name && $color_image) {
        $colors[$color_name] = $color_image;
        $update_query = "UPDATE products SET color_options = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode($colors), $id);
        $stmt->execute();
        $success_message = "Color added successfully!";
    }
}

// Handle Delete Color
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_color'])) {
    $color_name = $_POST['color_name'] ?? '';
    if ($color_name && isset($colors[$color_name])) {
        unset($colors[$color_name]);
        $update_query = "UPDATE products SET color_options = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode($colors), $id);
        $stmt->execute();
        $success_message = "Color deleted successfully!";
    }
}
// Handle Add Link
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_link') {
    $link = $_POST['value'] ?? '';
    if ($link) {
        $product_details = json_decode($product['product_details'], true) ?? [];
        $product_details[] = $link; // Add new link
        $update_query = "UPDATE products SET product_details = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode($product_details, JSON_UNESCAPED_SLASHES), $id);
        $stmt->execute();
        $success_message = "Link added successfully!";
    }
}

// Handle Delete Link
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_link') {
    $link = $_POST['value'] ?? '';
    $product_details = json_decode($product['product_details'], true) ?? [];
    if (($key = array_search($link, $product_details)) !== false) {
        unset($product_details[$key]); // Remove link
        $product_details = array_values($product_details); // Reindex array
        $update_query = "UPDATE products SET product_details = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', json_encode($product_details, JSON_UNESCAPED_SLASHES), $id);
        $stmt->execute();
        $success_message = "Link deleted successfully!";
    }
}

?>
<?php include 'header.php';?>
    <title>Edit Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; max-width: 98%; margin: 0 auto; padding: 30px; background: #f9f9f9; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        select, button { padding: 10px; font-size: 16px; width: 100%; margin-bottom: 10px; }
        input  { padding: 10px; font-size: 16px; width: 100%; margin-bottom: 10px; }
        button { background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        .slider-images, .color-list { display: flex; flex-wrap: wrap; gap: 15px; }
        .slider-images img, .color-item img { width: 100px; height: 100px; object-fit: cover; }
        .delete-button { background: red; color: white; border: none; border-radius: 5px; width: auto;  cursor: pointer; margin-left: 18px;}
        .delete-button:hover { background: darkred; }
    </style>

    <br><br><br>
    <main>
    <h1><?= htmlspecialchars($product['product_name']) ?></h1>
    <?php if ($success_message): ?><p style="color: green;"><?= $success_message ?></p><?php endif; ?>
    <?php if ($error_message): ?><p style="color: red;"><?= $error_message ?></p><?php endif; ?>

    <form method="POST">
        <div class="form-group">
        <label>Product URL (Read-Only)</label>
        <input type="text" value="<?= htmlspecialchars($product['product_url']) ?>" readonly>
    </div>
    <div class="form-group">
        <label>Product Image URL</label>
        <input 
            type="text" 
            name="product_image" 
            id="product_image" 
            value="<?= htmlspecialchars($product['product_image']) ?>" 
            oninput="updateImagePreview()" 
            required
        >
        <div class="image-preview">
            <p>Image Preview:</p>
            <img 
                id="image_preview" 
                src="<?= htmlspecialchars($product['product_image']) ?>" 
                alt="Product Image Preview" 
                style="max-width: 100px; max-height: 100px; object-fit: cover; border: 1px solid #ccc;"
            >
        </div>

        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Delivery Message</label>
            <select name="delivery_msg">
                <?php foreach (['Free delivery', 'Free delivery by 2 days', 'Free delivery by 3 days', 'Free delivery by 4 days', 'Free delivery by 5 days', 'Free delivery by 6 days', 'Free delivery by Tomorrow'] as $option): ?>
                    <option value="<?= $option ?>" <?= $product['delivery_msg'] === $option ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>MRP Price</label>
            <input type="number" name="mrp_price" value="<?= htmlspecialchars((int)$product['mrp_price']) ?>" required>
        </div>
        <div class="form-group">
            <label>Selling Price</label>
            <input type="number" name="sell_price" value="<?= htmlspecialchars((int)$product['sell_price']) ?>" required>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" id="category" onchange="toggleMobileOptions()">
                <?php foreach (['mobiles', 'home-and-kitchen', 'tv-appliances', 'smart-gadget', 'beauty-toys-sports', 'electronics-accesories', 'aristocrat', 'women-fashion', 'men-fashion', 'footware', 'others'] as $option): ?>
                    <option value="<?= $option ?>" <?= $product['category'] === $option ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="mobile-options" class="form-group" style="display: <?= $product['category'] === 'mobiles' ? 'block' : 'none' ?>;">
            <label>Storage Options</label>
            <select name="storage_options">
                <?php foreach (['128 GB', '256 GB', '512 GB', '1 TB'] as $option): ?>
                    <option value="<?= $option ?>" <?= $product['storage_options'] === $option ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
            <label>RAM</label>
            <select name="ram">
                <?php foreach (['4 GB', '6 GB', '8 GB', '12 GB', '16 GB'] as $option): ?>
                    <option value="<?= $option ?>" <?= $product['ram'] === $option ? 'selected' : '' ?>><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="edit_product">Save Changes</button>
    </form>

    <h2>Slider Images</h2>
    <form method="POST">
        <input type="text" name="value" placeholder="Enter Image URL" required>
        <button type="submit" name="action" value="add_slider">Add Image</button>
    </form>
    <div class="slider-images">
        <?php foreach ($slider_images as $image): ?>
            <div>
                <img src="<?= htmlspecialchars($image) ?>" alt="Slider Image">
                <form method="POST">
                    <input type="hidden" name="value" value="<?= htmlspecialchars($image) ?>">
                    <button class="delete-button" name="action" value="delete_slider">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Product Colors</h2>
    <form method="POST">
        <input type="text" name="color_name" placeholder="Enter Color Name" required>
        <input type="url" name="color_image" placeholder="Enter Image URL" required>
        <button type="submit" name="add_color">Add Color</button>
    </form>
    <div class="color-list">
        <?php foreach ($colors as $name => $image): ?>
            <div class="color-item">
                <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>">
                <strong><?= htmlspecialchars($name) ?></strong>
                <form method="POST">
                    <input type="hidden" name="color_name" value="<?= htmlspecialchars($name) ?>">
                    <button class="delete-button" name="delete_color">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <h2>Product Details (Links)</h2>
<form method="POST">
    <input type="url" name="value" placeholder="Enter Link" required>
    <button type="submit" name="action" value="add_link">Add Link</button>
</form>
<div class="slider-images">
    <?php 
    $product_details = json_decode($product['product_details'], true) ?? [];
    foreach ($product_details as $link): ?>
        <div>
            <a href="<?= htmlspecialchars($link) ?>" target="_blank"><?= htmlspecialchars($link) ?></a>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="value" value="<?= htmlspecialchars($link) ?>">
                <button class="delete-button" name="action" value="delete_link">Delete</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

    <script>
        function toggleMobileOptions() {
            const category = document.getElementById('category').value;
            document.getElementById('mobile-options').style.display = category === 'mobiles' ? 'block' : 'none';
        }
    </script>
    <script>
    function updateImagePreview() {
        const imageUrl = document.getElementById('product_image').value;
        const preview = document.getElementById('image_preview');
        preview.src = imageUrl;
    }
</script>
</main>