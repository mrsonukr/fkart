<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipkart</title>
    <link rel="stylesheet" href="assets/css/style2.css">
    <script src="assets/js/min.js"></script>
    <?php include 'meta.php';?> <!-- Meta php common for all page -->
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>/* Custom CSS for the slider */
    .slider {
        margin: 10px auto;
        max-width: 100%;
        overflow: hidden;
        cursor: pointer; /* Change cursor to pointer on hover */
    }

    .carousel-item img {
        height: auto;
        object-fit: cover;
    }

    .carousel-indicators li {
        width: 6px !important;
        height: 6px !important;
        border: 0 !important;
        border-radius: 10px;
        list-style: none;
        background-color: rgb(169, 169, 169) !important;
    }

    .carousel-indicators {
        column-gap: 5px;
        background-color: rgba(0, 0, 0, 0.2);
        padding: 4px;
        border-radius: 29px;
        width: max-content;
        margin: auto;
        margin-bottom: 10px;
    }

    .carousel-indicators .active {
        background-color: white !important;
        width: 15px !important;
    }</style>

</head>
<body>
    
    <div class="custom-header">
        <div class="header-content">
            <!-- Menu Button -->
            <a class="menu-button" id="showmenu">
                <img src="assets/images/svg/menu.svg" alt="Menu">
            </a>
    
            <!-- Logo -->
            <a class="logo-link" href="#">
                <img class="main-logo" src="assets/images/svg/flogo.svg" alt="Logo">
            </a>
        </div>
    
        <!-- Header Menu -->
        <div class="header-menu">
            <!-- Download Button -->
            <a class="menu-button" href="#">
                <span class="icon-wrapper">
                    <img class="icon" src="assets/images/svg/download.svg" alt="Download">
                </span>
            </a>
    
            <!-- Cart Button -->
            <a class="menu-button" href="cart.php" onclick="openNav()">
    <img src="assets/images/svg/cart.svg" alt="Cart">
    <span class="header__cart-count header__cart-count--floating cart-count bubble-count">0</span>
</a>
        </div>
    </div>
    
    <div class="custom-search-container" id="customSearchGuid">
    <a href="" class="custom-search-link">
        <!-- Image placed inside the input field -->
        <img src="assets\images\svg\search.webp" alt="Search Icon" class="search-icon">
        <input type="text" class="custom-search-input" placeholder="Search for Products, Brands and More" value="" readonly>
    </a>
</div>

    <div class="scroller">
        <div class="scroller-inner">
            <!-- Add images to the scroller with URLs -->
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu1.jpg" alt="Menu 1">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu2.jpg" alt="Menu 2">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu3.jpg" alt="Menu 3">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu4.jpg" alt="Menu 4">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu5.jpg" alt="Menu 5">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu6.jpg" alt="Menu 6">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu7.jpg" alt="Menu 7">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu8.jpg" alt="Menu 8">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu9.jpg" alt="Menu 9">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu10.jpg" alt="Menu 10">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu11.jpg" alt="Menu 11">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu12.jpg" alt="Menu 12">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu13.jpg" alt="Menu 13">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu14.jpg" alt="Menu 14">
            </a>
            <a href="#" target="_blank">
                <img src="assets/images/scroller/menu15.jpg" alt="Menu 15">
            </a>
        </div>
    </div>
    <?php
// Include database connection
include('database/db.php');

// Fetch slider images from the database
$query = "SELECT * FROM slider_images WHERE status = 'active' ORDER BY id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Initialize the carousel indicators and items
    $carouselIndicators = '';
    $carouselItems = '';
    $activeClass = 'active'; // Make the first image active

    $index = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        // Generate the carousel indicators
        $carouselIndicators .= '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '" class="' . ($index == 0 ? 'active' : '') . '"></li>';

        // Generate the carousel items
        $carouselItems .= '
        <div class="carousel-item ' . ($index == 0 ? 'active' : '') . '">
            <img class="d-block w-100" src="' . htmlspecialchars($row['image_url']) . '" alt="slider' . ($index + 1) . '">
        </div>';

        $index++;
    }
} else {
    $carouselIndicators = '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
    $carouselItems = '<div class="carousel-item active">
                        <img class="d-block w-100" src="assets/images/slider/default.jpg" alt="default slider">
                      </div>';
}
?>
<div class="slider">
    <div class="row">
        <div class="col-sm-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php echo $carouselIndicators; ?>
                </ol>
                <div class="carousel-inner">
                    <?php echo $carouselItems; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Enable auto-play and pause on hover
        $('#carouselExampleIndicators').carousel({
            interval: 3000, // Auto-slide every 3 seconds
            pause: 'hover'  // Pause on hover
        });

        // Variables to store touch coordinates
        var touchStartX = 0;
        var touchEndX = 0;

        // Detect touch start (finger down)
        $('#carouselExampleIndicators').on('touchstart', function(event) {
            touchStartX = event.originalEvent.touches[0].pageX;
        });

        // Detect touch end (finger up)
        $('#carouselExampleIndicators').on('touchend', function(event) {
            touchEndX = event.originalEvent.changedTouches[0].pageX;

            // If swiped left (next image)
            if (touchStartX - touchEndX > 50) {
                $('#carouselExampleIndicators').carousel('next');
            }
            // If swiped right (previous image)
            else if (touchEndX - touchStartX > 50) {
                $('#carouselExampleIndicators').carousel('prev');
            }
        });
    });
    // Add click event listener on the carousel
$('#carouselExampleIndicators').on('click', function(event) {
    // Get the width of the carousel and the position of the click
    var carouselWidth = $(this).width();
    var clickPosition = event.pageX - $(this).offset().left;

    // If the click is in the left 25% of the carousel, show the previous image
    if (clickPosition < carouselWidth * 0.25) {
        $('#carouselExampleIndicators').carousel('prev');
    }
    // If the click is in the right 25% of the carousel, show the next image
    else if (clickPosition > carouselWidth * 0.75) {
        $('#carouselExampleIndicators').carousel('next');
    }
});

</script>
<main>
<div class="product-list">
<?php

$query = "
    (SELECT * FROM products WHERE status = 'pin')  -- First, fetch 'pin' products
    UNION ALL
    (SELECT * FROM products WHERE status != 'pin' ORDER BY RAND())  -- Then, fetch other products in random order
    ORDER BY FIELD(status, 'pin') DESC, RAND();  -- Ensures 'pin' products are on top, rest are random
";
$result = mysqli_query($conn, $query);

// Check if any products are found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Get product status
        $status = $row['status'];

        // Skip products with "hide" status
        if ($status === 'hide') {
            continue; // Skip this product and do not display
        }

        // Retrieve other product data
        $product_url = "product.php/?product_url=" . $row['product_url'];
        $product_name = $row['product_name'];
        $company_name = $row['company_name'];
        $total_ratings = $row['total_ratings'];
        $product_image = $row['product_image'];
        $off_percentage = $row['off_percentage'];
        $mrp_price = number_format($row['mrp_price'], 0); // Remove decimals
        $sell_price = number_format($row['sell_price'], 0); // Remove decimals
        $product_message = $row['product_message'];
        $delivery_msg = $row['delivery_msg'];
        $rating = (int) filter_var($row['rating'], FILTER_SANITIZE_NUMBER_INT); // Extract rating number

        // Map product messages to their corresponding CSS classes
        $message_class = "";
        switch ($product_message) {
            case 'Last 1 left':
                $message_class = 'one-left';
                break;
            case 'Last 3 left':
                $message_class = 'three-left';
                break;
            case 'Only Few left':
                $message_class = 'few-left';
                break;
            case 'Lowest Price in 30 days':
                $message_class = 'lowest-price';
                break;
            case 'Bank Offer':
                $message_class = 'bank-offer';
                break;
            case 'Top Discount of the Sale':
                $message_class = 'top-discount';
                break;
            case 'Hot Deal':
                $message_class = 'saver-deal';
                break;
            case 'Limited Time Deal':
                $message_class = 'limit-discount';
                break;
            default:
                $message_class = ''; // Default class if no match
                break;
        }
?>

<style>
            .company-name{
                font-size: 14px;
                color: black;
                margin-bottom: 0;
            }
        </style>

<!-- Product Card HTML -->
<a href="<?php echo $product_url; ?>" class="product-card" data-id="<?php echo $row['id']; ?>">
    <div class="product-img">
        <img src="<?php echo $product_image; ?>" alt="">

        <?php if ($status === 'pin'): ?>
            <!-- Add pinned logic if necessary -->
        <?php endif; ?>

        <div class="heart-fav">
            <svg width="24" height="24" viewBox="0 0 256 256">
                <path fill="none" d="M0 0h256v256H0z"></path>
                <path d="M128 216S28 160 28 92a52 52 0 0 1 100-20h0a52 52 0 0 1 100 20c0 68-100 124-100 124Z" fill="#fff" stroke="#B8BBBF" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
            </svg>
        </div>
    </div>

    <?php
    // Decode color options and check if multiple colors exist
    $colorOptions = json_decode($row['color_options'], true);
    if (is_array($colorOptions) && count($colorOptions) >= 2): ?>
        <div class="multi-color">
            <img src="multi.png" alt="Multiple Colors Available">
        </div>
    <?php endif; ?>

    <div class="product-details">
        <p class="company-name"><?php echo htmlspecialchars($company_name); ?></p>
        <h3 class="product-name"><?php echo htmlspecialchars($product_name); ?></h3>
        <div class="product-price">
            <span class="off-percentage"><?php echo (int)$off_percentage; ?>% off</span>
            <span class="mrp-price line-through">₹<?php echo $mrp_price; ?></span>
            <span class="sell-price">₹<?php echo $sell_price; ?></span>
        </div>
        

        <!-- Product Message -->
        <div class="product-message <?php echo $message_class; ?>">
            <?php echo $product_message; ?>
        </div>

        <!-- Rating -->
        <div class="rating-box">
            <div class="rating-container">
                <?php
                $svg_path = "assets/images/svg/rating" . $rating . ".svg";
                if (file_exists($svg_path)) {
                    echo file_get_contents($svg_path);
                } else {
                    echo '<img class="rating_svg" src="assets/images/svg/rating1.svg" height="16px" alt="Product Rating">';
                }
                ?>
            </div>
            
            <img class="assured" src="assets/images/svg/assured_new.png" height="16px">
        </div>

       <!-- Delivery Message -->
<div class="delivery-msg">
    <?php
    if (preg_match('/\bby (\d+) days\b/', $delivery_msg, $matches)) {
        $days = (int)$matches[1];
        $delivery_date = new DateTime();
        $delivery_date->modify("+$days days");
        $formatted_date = $delivery_date->format('j M'); // No weekday
        echo "<span class='delivery-text'>Free delivery by {$formatted_date}</span>";
    } else {
        echo "<span class='delivery-text'>{$delivery_msg}</span>";
    }
    ?>
</div>


    </div>
</a>



<!--End Product Card HTML -->
<?php
    }
} else {
    echo "<p>No products found.</p>";
}

// Close database connection
mysqli_close($conn);
?>
</div>
<style>
 .product-list a {
    text-decoration: none;
}
.rating-box {
    display: flex;
    padding-top: 4px;
    padding-bottom: 4px;

}

.rating-container {
    display: flex;
    align-items: center;
    margin-right: 5px; /* Adjusts space between SVG and total rating */
}
.assured {
margin-top: 2px;
margin-right: 6px;
}
.fixed {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }
.delivery-msg{
    text-decoration: none;
}
.delivery-msg:hover {color: black;}
</style>
</main>
<script>// Get the custom search container
        let customSearchContainer = document.getElementById('customSearchGuid');
        
        // Get the initial position of the custom search bar from the top
        let sticky = customSearchContainer.offsetTop;
        
        window.onscroll = function() {
            // Check the scroll position
            if (window.pageYOffset >= sticky) {
                // When scrolled past the search bar, make it fixed
                customSearchContainer.classList.add("fixed");
            } else {
                // When scrolling back up, remove the fixed class
                customSearchContainer.classList.remove("fixed");
            }
        };
        </script>
</body>
</html>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to update the cart count
    function updateCartCount() {
        let products = [];
        if (localStorage.getItem('products')) {
            products = JSON.parse(localStorage.getItem('products'));
        }
        // Update the cart count display
        $(".header__cart-count--floating").text(products.length);
        if (products.length > 0) {
            $(".header__cart-count--floating").removeClass("d-none");
        } else {
            $(".header__cart-count--floating").addClass("d-none");
        }
    }

    // Call the function to set the initial cart count when the document is ready
    $(document).ready(function() {
        updateCartCount();
    });

    // Listen for visibility change (when the user returns to the page)
    document.addEventListener("visibilitychange", function() {
        if (!document.hidden) {
            updateCartCount();
        }
    });
</script>

