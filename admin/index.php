<?php include('header.php'); ?>
  <link rel="stylesheet" href="css/content.css">
  <!-- Main Content of the Page -->
  <div class="main-content">

 


    <style>
        /* Basic CSS for styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
           
            text-align: center;
        }
        .container h2 {
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-top: 15px;
            text-align: left;
        }
        label {
            font-size: 14px;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 8px;
        }
        .btn {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            margin-top: 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 15px;
            font-size: 14px;
            color: #4caf50;
        }
        .error {
            color: #ff4d4d;
        }
    </style>

<style>/* Global Styles */


h1, h2 {
    color: #343a40;
    text-align: center;
    margin-bottom: 20px;
}

/* Form and Button Styles */
form {
    margin-bottom: 30px;
    text-align: center;
}

.form-group {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 15px;
}

input[type="text"] {
    padding: 10px;
    font-size: 16px;
    width: 350px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    background-color: #007bff;
    color: white;
}

button:hover {
    background-color: #0056b3;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #343a40;
    color: #ffffff;
}

table td img {
    width: 100px;
    height: auto;
    border-radius: 5px;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #e9ecef;
}

/* Status Button Styles */
button.active {
    background-color: #28a745;
    color: white;
}

button.inactive {
    background-color: #dc3545;
    color: white;
}

button.active:hover, button.inactive:hover {
    background-color: #218838;
    background-color: #c82333;
}

/* Delete Button */
button.delete {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    border: none;
}

button.delete:hover {
    background-color: #c82333;
}

</style>
    <?php
// Include the database connection
require 'db.php';

// Handle adding a new image
if (isset($_POST['add_image'])) {
    $image_url = $_POST['image_url'];
    $status = 'active'; // Default status is active
    $stmt = $conn->prepare("INSERT INTO slider_images (image_url, status) VALUES (?, ?)");
    $stmt->bind_param("ss", $image_url, $status);
    $stmt->execute();
    header("Location: slider.php");
    exit();
}

// Handle status update via AJAX
if (isset($_POST['update_status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE slider_images SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    echo "Status updated";
    exit();
}

// Handle deleting an image
if (isset($_POST['delete_image'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM slider_images WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: slider.php");
    exit();
}

// Fetch all slider images
$result = $conn->query("SELECT * FROM slider_images");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Manager</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to toggle image status (active/inactive)
        function toggleStatus(id, currentStatus) {
            var newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'slider.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('status_' + id).innerHTML = newStatus;
                    document.getElementById('status_btn_' + id).innerHTML = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    document.getElementById('status_btn_' + id).classList.toggle('active');
                    document.getElementById('status_btn_' + id).classList.toggle('inactive');
                }
            };
            xhr.send('update_status=1&id=' + id + '&status=' + newStatus);
        }

        // Function to delete an image
        function deleteImage(id) {
            if (confirm('Are you sure you want to delete this image?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'slider.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('image_row_' + id).remove();
                    }
                };
                xhr.send('delete_image=1&id=' + id);
            }
        }
    </script>
</head>
<body>
    <h1>Slider Management</h1>
    
    <form action="slider.php" method="POST">
        <div class="form-group">
            <input type="text" name="image_url" placeholder="Enter Image URL" required>
            <button type="submit" name="add_image">Add Image</button>
        </div>
    </form>

    <h2>Slider Images</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Image Preview</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="image_row_<?php echo $row['id']; ?>">
                    <td><img src="<?php echo $row['image_url']; ?>" alt="Slider Image" width="100"></td>
                    <td id="status_<?php echo $row['id']; ?>"><?php echo $row['status']; ?></td>
                    <td>
                        <button id="status_btn_<?php echo $row['id']; ?>" class="<?php echo $row['status'] === 'active' ? 'active' : 'inactive'; ?>" onclick="toggleStatus(<?php echo $row['id']; ?>, '<?php echo $row['status']; ?>')">
                            <?php echo ucfirst($row['status']); ?>
                        </button>
                        <button onclick="deleteImage(<?php echo $row['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

</main>

<?php include('footer.php'); ?>
