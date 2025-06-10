<?php
include 'db.php'; // Your DB connection file

// Pagination variables
$limit = 50; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT id, product_name, product_url, category, status FROM products"; // Add 'status' field
if ($search) {
    $query .= " WHERE id LIKE '%$search%' OR product_name LIKE '%$search%' OR product_url LIKE '%$search%'";
}

// Get total number of products for pagination
$totalResult = $conn->query($query);
$totalProducts = $totalResult->num_rows;
$totalPages = ceil($totalProducts / $limit); // Calculate total pages

// Modify the query to limit results
$query .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<?php include('header.php'); ?>

    <title>Product List</title>
    <style>
     /* Reset some default styles */
* /* Google Fonts - Roboto */
@import url("https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap");

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Roboto', sans-serif; /* Use Roboto font */
    line-height: 1.6;
    background-color: #e3f2fd; /* Updated background color */
    color: #333;
    margin: 20px;
}

/* Header styles */
h1 {
    text-align: center;
    color: #4CAF50; /* Keep the green header color */
    margin-bottom: 20px;
}
/* Search Bar Styles */
.search-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    padding: 10px; /* Add some padding around the search bar */
    background-color: #ffffff; /* White background for the search bar */
    border-radius: 5px; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.search-bar input {
    width: 300px; /* Width of the input field */
    padding: 10px; /* Padding inside the input field */
    border: 2px solid #4CAF50; /* Green border */
    border-radius: 5px; /* Rounded corners for the input */
    font-size: 16px; /* Font size of the input text */
    outline: none; /* Remove the default outline on focus */
    transition: border-color 0.3s; /* Smooth transition for border color */
}

.search-bar input:focus {
    border-color: #45a049; /* Darker green border on focus */
}

.search-bar button {
    padding: 12px 20px; /* Padding for the button */
    background-color: #4CAF50; /* Green background for the button */
    color: white; /* White text color */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners for the button */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
    margin-left: 10px; /* Space between input and button */
}

.search-bar button:hover {
    background-color: #45a049; /* Darker green on hover */
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f4f4f4;
    color: #333;
}

tr:hover {
    background-color: #f1f1f1; /* Light gray on hover */
}

/* Button styles for actions */
.action-button {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

/* Specific styles for each button */
.pin {
    background-color: #4CAF50; /* Green */
}

.unpin {
    background-color: #2196F3; /* Blue */
}

.hide {
    background-color: #f44336; /* Red */
}

.unhide {
    background-color: #8bc34a; /* Light Green */
}

.edit {
    background-color: #FFC107; /* Amber */
    text-decoration: none;
}

/* Hover effects */
.action-button:hover {
    transform: scale(1.05); /* Slightly increase size on hover */
}

.pin:hover, .unpin:hover {
    background-color: #45a049; /* Darker green for pin/unpin */
}

.hide:hover, .unhide:hover {
    background-color: #e53935; /* Darker red for hide/unhide */
}

.edit:hover {
    background-color: #FFA000; /* Darker amber for edit */
}

/* Pagination styles */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination a {
    padding: 10px 15px;
    margin: 0 5px;
    text-decoration: none;
    color: #4CAF50; /* Green color for links */
    border: 1px solid #4CAF50; /* Border color */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
}

.pagination a:hover {
    background-color: #4CAF50; /* Green background on hover */
    color: white; /* White text on hover */
}

.pagination a[style*="font-weight:bold;"] {
    background-color: #4CAF50; /* Highlight the current page */
    color: white; /* White text for the current page */
    border: none; /* Remove border for the current page */
}

/* Responsive styles */
@media (max-width: 768px) {
    .search-bar {
        flex-direction: column;
        align-items: center;
    }

    .search-bar input {
        width: 100%;
        margin-bottom: 10px;
 }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 10px;
    }

    .status-button {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 24px;
    }

    .search-bar input {
        width: 100%;
    }

    .search-bar button {
        width: 100%;
    }

    table {
        font-size: 12px;
    }
}
.filter-buttons {
    margin-bottom: 20px;
}

.filter-button {
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    color: black;
    background-color: white; /* White background for buttons */
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.filter-button.active {
    background-color: #4CAF50; /* Green background for active button */
    color: white;
}

.filter-button:hover {
    background-color: #45a049; /* Darker green on hover */
    color: white; /* White text on hover */
}
    </style>
</head>
<body>
   <br><br><br>
   <div class="search-bar">
    <form method="get">
        <input type="text" name="search" placeholder="Search by ID, Name, or URL" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
</div>
   <div class="filter-buttons">
    <button class="filter-button active" onclick="filterProducts('all')">All</button>
    <button class="filter-button" onclick="filterProducts('hidden')">Hidden</button>
    <button class="filter-button" onclick="filterProducts('pinned')">Pinned</button>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Product URL</th>
        <th>Category</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr data-status="<?= $row['status'] ?>"> <!-- Add data-status attribute -->
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars(substr($row['product_name'], 0, 15)) . (strlen($row['product_name']) > 15 ? '...' : '') ?></td>
        <td><?= htmlspecialchars($row['product_url']) ?></td>
        <td><?= htmlspecialchars($row['category']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td>
            <!-- Action buttons here -->

                <?php if ($row['status'] == 'pin'): ?>
                    <button class="action-button unpin" onclick="updateStatus(<?= $row['id'] ?>, 'default')">Unpin</button>
                <?php elseif ($row['status'] == 'hide'): ?>
                    <button class="action-button unhide" onclick="updateStatus(<?= $row['id'] ?>, 'default')">Unhide</button>
                <?php else: ?>
                    <button class="action-button pin" onclick="updateStatus(<?= $row['id'] ?>, 'pin')">Pin</button>
                    <button class="action-button hide" onclick="updateStatus(<?= $row['id'] ?>, 'hide')">Hide</button>
                <?php endif; ?>
            </td>
            <td><a href="edit.php?id=<?= $row['id'] ?>" class="action-button edit">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search) ?>">Previous</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" <?= ($i == $page) ? 'style="font-weight:bold;"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search) ?>">Next</a>
        <?php endif; ?>
    </div>

    <script>
    function updateStatus(productId, newStatus) {
        // Directly redirect without confirmation
        window.location.href = 'status.php?id=' + productId + '&status=' + newStatus;
    }
    
</script>
<script>
function filterProducts(filter) {
    // Get all table rows (excluding the header row)
    var rows = document.querySelectorAll('table tr:not(:first-child)');

    // Show or hide rows based on the selected filter
    rows.forEach(function(row) {
        var status = row.getAttribute('data-status'); // Get the status from data attribute
        if (filter === 'hidden' && status === 'hide') {
            row.style.display = ''; // Show the row if status is 'hide' and filter is 'hidden'
        } else if (filter === 'pinned' && status === 'pin') {
            row.style.display = ''; // Show the row if status is 'pin' and filter is 'pinned'
        } else if (filter === 'all') {
            row.style.display = ''; // Show all rows if filter is 'all'
        } else {
            row.style.display = 'none'; // Hide the row otherwise
        }
    });

    // ```javascript
    // Update the active button
    var buttons = document.querySelectorAll('.filter-button');
    buttons.forEach(function(button) {
        button.classList.remove('active');
    });
    document.querySelector('.filter-button[onclick="filterProducts(\'' + filter + '\')"]').classList.add('active');
}
</script>
</body>
</html>