<?php
// Include database connection
include('db.php');

// Get the unique product_url from the URL
if (isset($_GET['product_url'])) {
    $product_url = $_GET['product_url'];

    // Prepare the SQL statement to fetch the product data
    $sql = "SELECT * FROM products WHERE product_url = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $product_url);  // 's' means the parameter is a string
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product URL.";
    exit;

}
function getRandomTimeAgo()
{
    $timeUnits = [
        'minute' => rand(1, 59),
        'hour' => rand(1, 23),
        'day' => rand(1, 6),
        'week' => rand(1, 4),
        'month' => rand(1, 12)

    ];

    // Choose a random unit
    $unit = array_rand($timeUnits);
    $value = $timeUnits[$unit];

    // Handle singular/plural formatting
    $unitFormatted = $value > 1 ? $unit . 's' : $unit;

    return "$value $unitFormatted ago";
}
// Pre-fetch 10 random names and cities for reviews
$nameQuery = "SELECT name FROM names ORDER BY RAND() LIMIT 10";
$cityQuery = "SELECT city FROM cities ORDER BY RAND() LIMIT 10";
$nameResult = $conn->query($nameQuery);
$cityResult = $conn->query($cityQuery);

// Fetch the results into arrays
$names = [];
$cities = [];
if ($nameResult->num_rows > 0) {
    while ($row = $nameResult->fetch_assoc()) {
        $names[] = htmlspecialchars($row['name']);
    }
}
if ($cityResult->num_rows > 0) {
    while ($row = $cityResult->fetch_assoc()) {
        $cities[] = htmlspecialchars($row['city']);
    }
}

// Fetch the product data
$ram = $product['ram'];
$category = $product['category'];
$color_options = $product['color_options'];
$colors = json_decode($color_options, true);
$product_name = $product['product_name'];
$mrp_price = $product['mrp_price'];
$sell_price = $product['sell_price'];
$storage = $product['storage_options'];
$discount = $product['off_percentage'];
$total_rating = $product['total_ratings'];
$product_image = $product['product_image'];
$delivery_msg = $product['delivery_msg'];
$rating = isset($product['rating']) ? $product['rating'] : 'rating0.svg';
$ratingPoint = (int) filter_var($rating, FILTER_SANITIZE_NUMBER_INT);
$slider_images = !empty($product['slider_images']) ? json_decode($product['slider_images'], true) : [];
$product_url = $product['product_url'];  // For potential further use
?>


<!DOCTYPE html>
<html lang="en-IN">

<head>

    <link rel="shortcut icon" href="https://huntbars.shop/assets/images/favicon.png">
    <link rel="stylesheet" href="/home/style.css">
    <script src="/home/min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title><?php echo $product_name; ?></title>
    <style>
        body,
        a,
        p,
        span,
        div,
        input,
        button,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: 'Inter', sans-serif;
            /* Apply Roboto font to the entire body */
        }

        .carousel-control-prev,
        .carousel-control-next {
            opacity: 0;
            /* Sets the opacity to 0 (fully transparent) */
            /* Prevents interaction with the controls */
        }

        .order-info {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-info img {
            width: 24px;
            /* Optional: set the size of the image */
            height: 24px;
            /* Optional: set the size of the image */
        }

        .order-info div {
            margin-left: 8px;
            /* Space between icon and text */
        }

        .all-offers {
            display: flex;
            justify-content: space-between;
            /* Ensures items are spaced properly */
            align-items: center;
            /* Aligns items vertically in the center */
        }

        .storage {
            display: flex;
            align-items: center;
            /* Align the text and the storage value horizontally */
        }

        .dress-size {
            font-weight: bold;
            margin-left: 5px;
            /* Adds some space between the text and the value */
        }

        .ao-img {
            display: flex;
            align-items: center;
        }

        /* Loader container styles */
        .loader-container {
            position: fixed;
            /* Fixes the loader to the viewport */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            /* Optional: semi-transparent background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Ensures the loader is above all other content */
        }

        /* Loader styles */
        .loader {
            border: 5px solid #f3f3f3;
            /* Light grey */
            border-top: 5px solid #4285f4;
            /* Blue */
            border-left: 5px solid #4285f4;
            border-radius: 50%;
            width: 50px;
            /* Size of the loader */
            height: 50px;
            /* Size of the loader */
            animation: spin 1s linear infinite;
        }

        /* Animation for the loader */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .review-section {
            border: 1px solid #ddd;

            padding: 16px;
        }

        .actions img {
            margin-right: 5px;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-bottom: -5px;
        }

        .rating span {
            color: #4caf50;
            font-size: 1.2em;
            margin-right: 8px;
            margin-top: -16px;
        }

        .rating p {
            font-weight: 400;
            font-size: 15px;
        }

        .review-details {
            margin-bottom: 12px;
        }

        .review-details p {
            margin: 0;
            color: #555;
        }

        .review-text {
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 12px;
            color: #222;
        }

        .emoji {
            color: #e91e63;
        }

        .reviewer-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reviewer-info span {
            font-size: 14px;
            color: #888;
            margin-bottom: -8px;
        }

        .action-box {
            display: flex;
            /* Arrange children horizontally */
            justify-content: space-between;
            /* Push elements to edges */
            align-items: center;
            /* Vertically align children */
            gap: 16px;
            /* Add spacing between actions and three-dot */
        }

        .actions {
            display: flex;
            gap: 16px;
            /* Space between action buttons */
            margin-top: 12px;
        }

        .actions div {
            display: flex;
            align-items: center;
            border: 1px solid #e2e2e2;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: 0.9em;
            color: #555;
            cursor: pointer;
        }

        .three-dot {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            margin-top: 15px;
            cursor: pointer;
        }

        .actions div:hover {
            color: #000;
        }

        .verified {
            font-size: 12px;
            color: rgb(133, 137, 143);
            margin-top: 8px;
            display: flex;
            font-weight: 400;
            margin-bottom: -10px;
        }

        .verified img {
            margin-right: 4px;
            margin-top: 2px;
            width: 15px;
            height: 15px;

        }
    </style>

</head>
<div id="container" style="overflow:hidden">
    <div style="height:100%" data-reactroot="">

        <!-- Header Start Here -->
        <div class="_2dxSCm">
            <div class="_38U37R">
                <div class="_1FWdmb">
                    <div class="d-flex align-items-center">
                        <a class="_3NH1qf" id="back-btn" style="margin-top:5px;">
                            <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="#000" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                            </svg>
                        </a>
                        <a class="_3NH1qf d-none" id="showmenu">
                            <svg width="100%" height="100%" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 17.2222C2 17.8359 2.49746 18.3333 3.11111 18.3333H20.8889C21.5025 18.3333 22 17.8359 22 17.2222C22 16.6086 21.5025 16.1111 20.8889 16.1111H3.11111C2.49746 16.1111 2 16.6086 2 17.2222ZM2 11.6667C2 12.2803 2.49746 12.7778 3.11111 12.7778H20.8889C21.5025 12.7778 22 12.2803 22 11.6667C22 11.053 21.5025 10.5556 20.8889 10.5556H3.11111C2.49746 10.5556 2 11.053 2 11.6667ZM3.11111 5C2.49746 5 2 5.49746 2 6.11111C2 6.72476 2.49746 7.22222 3.11111 7.22222H20.8889C21.5025 7.22222 22 6.72476 22 6.11111C22 5.49746 21.5025 5 20.8889 5H3.11111Z"
                                    fill="#333333"></path>
                            </svg>
                        </a>
                        <a class="Z4_K_h" href="https://huntbars.shop/" style="margin: 0 10px;">
                            <img class="logop" src="/home/favicon.png" style="width:25px;">
                        </a>
                    </div>
                    <div class="header-menu">
                        <a class="_3NH1qf" href="#" onclick="openNav()">
                            <img src="/home/cart.svg" alt="">
                            <span class="header__cart-count header__cart-count--floating bubble-count">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sc-bBXxYQ jMfCEJ"></div>

        <body class="expansion-alids-init" cz-shortcut-listen="true">
            <div class="loader-container">
                <div class="loader"></div>
            </div>

            <script>
                window.onload = function () {
                    // Hide the loader container once the page is fully loaded
                    const loaderContainer = document.querySelector('.loader-container');
                    loaderContainer.style.display = 'none'; // Optionally hide it
                    loaderContainer.remove(); // Remove it from the DOM
                };
            </script>
            <!-- Header End Here -->
            <div class="relative-container">
                <!-- Product Slider Start Here -->
                <div class="container-fluid px-0 product-slider">
                    <div id="sliderX" class="carousel slide <?php echo empty($slider_images) ? 'd-none' : ''; ?>"
                        data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            // Custom image as the first item, so we need to adjust the indicators
                            echo "<li data-bs-target='#sliderX' data-bs-slide-to='0' class='active'></li>"; // Custom image indicator
                            $index = 1; // Start index for slider images
                            if (!empty($slider_images)) {
                                foreach ($slider_images as $url) {
                                    echo "<li data-bs-target='#sliderX' data-bs-slide-to='{$index}'></li>";
                                    $index++;
                                }
                            }
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            
                            <?php
                            // Show the custom image as the first item
                            echo "
            <div class='carousel-item active'>
                <img class='d-block w-100 product_img active' src='{$product_image}' alt='Custom Image'>
            </div>";

                            // Show the other images from the $slider_images array if they are available
                            if (!empty($slider_images)) {
                                foreach ($slider_images as $url) {
                                    echo "
                    <div class='carousel-item'>
                        <img class='d-block w-100' src='{$url}' alt='Slide'>
                    </div>";
                                }
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#sliderX" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#sliderX" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>

                    <?php if (empty($slider_images)): ?>
                        <div class="single-image">
                            <img class='d-block w-100' src='<?php echo $product_image; ?>' alt='Custom Image'>
                        </div>
                    <?php endif; ?>
                </div>


                <!-- Product Slider End Here -->
                <div class="custom-icon-container">
                    <div class="custom-icon-wrapper">
                        <div class="custom-icon-content">
                            <!-- Heart Icon -->
                            <svg width="24" height="24" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" d="M0 0h256v256H0z"></path>
                                <path
                                    d="M128 216S28 160 28 92a52 52 0 0 1 100-20h0a52 52 0 0 1 100 20c0 68-100 124-100 124Z"
                                    fill="#fff" stroke="#717478" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="12"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="custom-icon-wrapper">
                        <div class="custom-icon-content">
                            <!-- Share Icon -->
                            <svg width="24" height="24" fill="none" viewBox="0 0 22 22"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M13.187 2.316v4.323c-7.655 1.08-10.936 6.484-12.03 11.887 2.735-3.782 6.562-5.511 12.03-5.511v4.43l7.655-7.564-7.655-7.565Z"
                                    fill="#fff" stroke="#717478" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <!-- trend strart here -->

            <div class="order-info">
                <div>
                    <img src="https://store.stone-stoke.fun//assets/images/Incresase.svg" alt="Increase Icon">
                </div>
                <div id="order-info"></div>

            </div>

            <!-- select color -->
            <div class="d-margin">
                <div class="container-fluid p-0">
                    <?php
                    // Check if color_options is not null or empty
                    if (!empty($color_options)) {
                        // Decode the JSON string into a PHP associative array
                        $colors = json_decode($color_options, true);
                        if (is_array($colors) && !empty($colors)) {
                            ?>
                            <div class="color-div">
                                <div class="color-list p-2">
                                    <?php
                                    // Track the first color to set as default
                                    $first_color = true;
                                    // Loop through each color and create a color box for it
                                    foreach ($colors as $color_name => $color_image_url) {
                                        // If it's the first color, set the 'active' class
                                        $active_class = $first_color ? 'active' : '';
                                        $first_color = false; // Set to false after the first iteration
                                        ?>
                                        <div class="color-box color-item p-2 me-2 <?php echo $active_class; ?>"
                                            data-mrp="<?php echo (int) $mrp_price; ?>"
                                            data-selling-price="<?php echo (int) $sell_price; ?>"
                                            onclick="manage_color_click($(this), '<?php echo $color_name; ?>', '0', 0, '<?php echo $color_image_url; ?>');">
                                            <img class="main_image" src="<?php echo $color_image_url; ?>"
                                                alt="<?php echo $color_name; ?>" class="color_img_0">
                                            <span class="color-name"><?php echo $color_name; ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        // If color_options is empty, show default color and product image
                        $default_color_name = "Default";  // You can customize this name
                        $default_color_image = $product_image; // Use the product image as default color image
                        ?>
                        <div class="color-div" style="display: none;">
                            <div class="color-list p-2">
                                <div class="color-box color-item p-2 me-2 active" data-mrp="<?php echo (int) $mrp_price; ?>"
                                    data-selling-price="<?php echo (int) $sell_price; ?>"
                                    onclick="manage_color_click($(this), '<?php echo $default_color_name; ?>', '0', 0, '<?php echo $default_color_image; ?>');">
                                    <img class="main_image" src="<?php echo $default_color_image; ?>"
                                        alt="<?php echo $default_color_name; ?>" class="color_img_0">
                                    <span class="color-name"><?php echo $default_color_name; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>



                    <p class="company-name">Apple <span class="product-title"><?php echo $product_name; ?></span></p>

                    <div class="rating-area">
                        <div class="rating-img"><img src="/home/<?php echo $rating; ?>" alt="rating"></div>
                        <div class="rating-point"><?php echo $ratingPoint; ?>.0</div>
                        <div class="total-rating-num"><span class="dot-rate"></span><?php echo $total_rating; ?> ratings
                        </div>
                        <div class="f-assured">
                            <div><img src="/home/assured_new.png" alt="F-Assured"></div>
                        </div>
                    </div>


                    <div class="product-price d-flex my-2">
                        <span class="discount"><?php echo (int) $discount; ?> off</span>
                        <span class="mrp"
                            data-mrp="<?php echo (int) $mrp_price; ?>">&#8377;<?php echo (int) $mrp_price; ?></span>
                        <span class="price"
                            data-price="<?php echo (int) $sell_price; ?>">&#8377;<?php echo (int) $sell_price; ?></span>

                    </div>


                    <div class="delivery-date">
                        <p>
                            <?php
                            if (preg_match('/\bby (\d+) days\b/', $delivery_msg, $matches)) {
                                $days = (int) $matches[1];
                                $delivery_date = new DateTime();
                                $delivery_date->modify("+$days days");
                                $formatted_date = $delivery_date->format('j M, l');
                                echo "Free delivery by {$formatted_date}";
                            } else {
                                echo $delivery_msg;
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="space" style="height: 7px;"></div>

            <?php
            if ($category == "mobiles") {
                // Show content for mobiles
                ?>
                <div class="pin-text" style="margin: 10px 16px; font-size: 14px;">Select Variant</div>
                <div class="space" style="height: 1px;"></div>

                <div class="all-offers" style="margin: -10px -4px;">
                    <div class="ao-text">Color: <strong>Default</strong></div>
                    <div class="ao-img"><img src="/home/images/next-arrow.png" alt=""></div>
                </div>
                <div class="space" style="height: 1px;"></div>

                <div class="all-offers" style="margin: -30px -4px;">
                    <div class="storage ao-text">Storage: <span class="dress-size active"
                            style="font-weight: 700;"><?php echo htmlspecialchars($storage); ?></span></div>
                    <div class="ao-img"><img src="/home/images/next-arrow.png" alt=""></div>
                </div>
                <?php
            } elseif ($category == "men-fashion") {
                // Show content for men fashion
                ?>
                <div class="cl-box">
                    <h6 class="cl-size-selection-heading">Select Size</h6>
                    <div class="cl-size-chart-icon">
                        <div class="cl-size-svg">
                            <img src="/home/size-chart.svg" alt="Size Chart">
                            <p>Size Chart</p>
                        </div>
                    </div>

                    <div class="cl-size-selector-chips">
                        <span class="dress-size active" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">S</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">M</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">L</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">XL</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">XXL</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">XXXL</span>
                        </span>
                    </div>
                </div>
                <?php
            } elseif ($category == "footware") {
                // Show content for laptops
                ?>
                <div class="cl-box">
                    <h6 class="cl-size-selection-heading">Select Size</h6>
                    <div class="cl-size-chart-icon">
                        <div class="cl-size-svg">
                            <img src="/home/size-chart.svg" alt="Size Chart">
                            <p>Size Chart</p>
                        </div>
                    </div>

                    <div class="cl-size-selector-chips">
                        <span class="dress-size active" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-7</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-8</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-9</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-10</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-11</span>
                        </span>
                        <span class="dress-size" onclick="manage_size_click($(this))">
                            <span class="cl-size-label">UK-12</span>
                        </span>
                    </div>
                </div>
                <?php
            } elseif ($category == "headphones") {
                // Show content for headphones
                ?>
                <div class="pin-text" style="margin: 10px 16px; font-size: 14px;">Select Headphone Variant</div>
                <div class="space" style="height: 1px;"></div>

                <div class="all-offers" style="margin: -10px -4px;">
                    <div class="ao-text">Color: <strong>Default</strong></div>
                    <div class="ao-img"><img src="/home/images/next-arrow.png" alt=""></div>
                </div>
                <div class="space" style="height: 1px;"></div>

                <div class="all-offers" style="margin: -30px -4px;">
                    <div class="storage ao-text">Storage: <span class="dress-size active"
                            style="font-weight: 700;"><?php echo htmlspecialchars($storage); ?></span></div>
                    <div class="ao-img"><img src="/home/images/next-arrow.png" alt=""></div>
                </div>
                <?php
            } else {
                // Default case for other categories
                ?>
                <?php
            }
            ?>


            <style>
                .cl-box {
                    padding: 10px 10px;
                    padding-top: 15px;
                }
            </style>
            <div class="space" style="height: 7px;"></div>

            <div class="pin-box">
                <div class="pin-text">Find a seller that delivers to you </div>
                <div class="pin-btn">Enter Pincode</div>
            </div>
            <div class="space" style="height: 2px;"></div>
            <div class="term-box">
                <div class="term-item">
                    <div class="term-box-img">
                        <img src="/home/images/terms1.png" alt="">
                    </div>
                    <div class="term-box-text">7 Days Service Center Replacement/Repair</div>
                </div>
                <div class="term-item">
                    <div class="term-box-img">
                        <img src="/home/images/terms2.png" alt="">
                    </div>
                    <div class="term-box-text">No Cash On Delivery</div>
                </div>
                <div class="term-item">
                    <div class="term-box-img">
                        <img src="/home/images/terms3.png" alt="">
                    </div>
                    <div class="term-box-text">F-Assured</div>
                </div>
            </div>
            <div class="space" style="height: 6px;"></div>
            <div class="all-offers">
                <div class="ao-text">All Offers & Coupons</div>
                <div class="ao-img"><img src="/home/images/next-arrow.png" alt=""></div>
            </div>

            <div class="space" style="height: 6px;"></div>

            <div class="container-fluid product-detail mb-4 card" style="margin-top: 3px;padding: 20px 16px;">
                <h6 font-size="17px" font-weight="bold" color="greyBase" class="sc-hBxehG jvhzrN">
                    Product Details
                </h6>
                <div class="product-details">
                    <center>
                      <img src="" alt="">
                    </center>
                </div>
            </div>
            <?php
            $reviewPhrases = [
                'Supper',
                'Brilliant',
                'Best in the market!',
                'Best',
                'Good',
                'Classy Products',
                'Exceptional Quality',
                'Top-tier Products',
                'Unmatched Excellence',
                'Premier Selection',
                'Outstanding Value',
                'The Ultimate Choice',
                'Unbeatable Quality',
                'Second to None',
                'Simply the Best',
                'Superior Craftsmanship',
                'World-Class Products',
                'Cutting-Edge Innovation',
                'Top-of-the-Line',
                'Elite Selection',
                'Outstanding Performance',
                'Premium Quality',
                'Remarkable Value',
                'Unrivaled Excellence',
                'Perfectly Crafted',
                'Next-Level Quality',
                'Unbeatable Performance'
            ];
            $positiveComments = [
                'Absolutely amazing!',
                'Couldn’t be happier with this product!',
                'Exceeds expectations!',
                'Quality is top-notch!',
                'Fantastic value for money!',
                'Highly recommend this!',
                'Best purchase I’ve made!',
                'Worth every penny!',
                'Extremely satisfied with this product!',
                'Will buy again!',
                'Definitely a great find!',
                'Perfect for my needs!',
                'I am in love with this product!',
                'This product is a game-changer!',
                'It’s just perfect!',
                'Incredible performance!',
                'So glad I bought this!',
                'I’m a huge fan of this product!',
                'Five stars, no doubt!',
                'You won’t regret it!',
                'Such a great deal!',
                'I can’t believe how great this is!',
                'Simply amazing!',
                'Best choice I’ve made!',
                'I’m thrilled with my purchase!',
                'This has made my life easier!',
                'Can’t recommend this enough!',
                'Impressed with the quality and performance!',
                'This product is unbeatable!'
            ];
            // List of sizes to choose from
            $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
            // List of sizes to choose from
            $uksizes = ['UK-6', 'UK-7', 'UK-8', 'UK-9', 'UK-10', 'UK-11', 'UK-12'];
 $color_name = 'Default'; // Default color name
            
            // Loop to generate 10 review cards
            for ($i = 0; $i < 10; $i++) {
                // Randomly pick a rating image and set the corresponding rating point
                $ratingNumber = rand(3, 5);  // Random number between 1 and 5
                $rating = 'rating' . $ratingNumber . '.svg';  // Set the rating image
                $ratingPoint = (float) $ratingNumber;  // Rating point corresponding to the image (1.0, 2.0, ..., 5.0)
                $randomReview = $reviewPhrases[array_rand($reviewPhrases)];
                $randomPositiveComment = $positiveComments[array_rand($positiveComments)];
                $size = $sizes[array_rand($sizes)];
                // Randomly pick a name and city
                $randomName = $names[$i % count($names)];
                $randomCity = $cities[$i % count($cities)];
                $uksize = $uksizes[array_rand($uksizes)];
                 // Select a random color from the available colors
    if (!empty($colors)) {
        $random_key = array_rand($colors); // Get a random key
        $color_name = $random_key; // Assign the random color name
    } else {
        $color_name = 'Default'; // Default color name
    }
                ?>

                <div class="review-section">
                    <div class="rating">
                        <span><img src="/home/<?php echo $rating; ?>" alt=""></span>
                        <p style="color: green; font-weight: 700 !important;"><?php echo $ratingPoint; ?>.0</p>
                        <p>&nbsp;•&nbsp;</p>
                        <p><?php echo $randomReview; ?></p>
                    </div>
                    <?php if ($category == 'mobiles'): ?>
                        <div class="review-details">
                            <p>Review for: Color <?php echo htmlspecialchars($color_name); ?> · RAM <?php echo htmlspecialchars($ram); ?> · Storage
                                <?php echo htmlspecialchars($storage); ?>
                            </p>
                        </div>
                    <?php elseif ($category == 'footware'): ?>
                        <div class="review-details">
                            <p>Review for: Color <?php echo htmlspecialchars($color_name); ?> · Size: <?php echo htmlspecialchars($uksize); ?></p>
                        </div>
                    <?php elseif ($category == 'men-fashion'): ?>
                        <div class="review-details">
                            <p>Review for: Color <?php echo htmlspecialchars($color_name); ?> · Size: <?php echo htmlspecialchars($size); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="review-details">
                            <p>Review for: Color <?php echo htmlspecialchars($color_name); ?></p>
                        </div>
                    <?php endif; ?>




                    <div class="review-text">
                        <?php echo $randomPositiveComment; ?></p></span>
                    </div>
                    <div class="reviewer-info">
                        <span><?php echo $randomName; ?>, <?php echo $randomCity; ?></span>
                    </div>
                    <div class="action-box">
                        <div class="actions">
                            <div>
                                <img src="/home/like.svg" alt="">
                                Helpful for <?php echo rand(1, 1500); ?>
                            </div>
                            <div>
                                <img src="/home/dislike.svg" alt="">
                                <?php echo rand(1, 800); ?>
                            </div>
                        </div>
                        <div class="three-dot" style="align-items: center; justify-content: center; width: 36px;">
                            <svg width="12" height="12" viewBox="0 0 256 256">
                                <path fill="none" d="M0 0h256v256H0z"></path>
                                <path fill="#717478"
                                    d="M156 128a28 28 0 1 1-28-28 28.1 28.1 0 0 1 28 28Zm-28-52a28 28 0 1 0-28-28 28.1 28.1 0 0 0 28 28Zm0 104a28 28 0 1 0 28 28 28.1 28.1 0 0 0-28-28Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="verified">
                        <img src="/home/verified.svg" alt="">
                        <p>Verified Purchase · <?php echo getRandomTimeAgo(); ?></p>
                    </div>

                </div>
            <?php } ?>
    </div>
        <br><br><br>

     <div class="button-container flex">
        <button class="buynow-button buynow-button-white product-page-buy add_cart" onclick="add_to_cart()">
            Add to Cart
        </button>
        <button class=" buynow-button product-page-buy buy_now" onclick="add_to_cart('buyNow')">
            Buy Now
        </button>
    </div>


    <script type="text/javascript">
        BASEURL = "";
        function manage_color_click(that, color, keys, color_id, all_images) {
            $(".color-item").removeClass('active');
            that.addClass("active");
            var images = all_images.split(',');
            var active_color = 0;
            images.forEach(function (image_url, i) {
                if (image_url != "") {
                    c_index = i + 1;
                    $(".slider-item-" + c_index).attr('src', image_url);
                }
            });
            $(".main_image  ").addClass('active');


        }
        $(document).ready(function () {

            // Ensure fresh product details when the page loads
            const product_id = $('.product-title').attr("data-id");
            const product_title = $('.product-title').html();  // This is the product name
            const price = parseInt($('.price').attr("data-price"));
            const mrp_price = parseInt($('.mrp').attr("data-mrp"));
            const product_img = $('.main_image').attr('src');
            const color = $('.color-item.active').find('span').text().trim();
            const storage = $('.storage-item.active').attr("storage-size");

            // Refresh the cart UI to reflect the current page state
            refreshCartState(product_id, product_title, color, storage);

            // Function to refresh cart state
            function refreshCartState(product_id, product_title, color, storage) {
                // Get current cart products from localStorage
                let products = [];
                if (localStorage.getItem('products')) {
                    products = JSON.parse(localStorage.getItem('products'));
                }

                // Loop through products to check if the product already exists in the cart
                products.forEach(function (product) {
                    if (product.product_id === product_id &&
                        product.color === color &&
                        product.storage === storage) {

                        // Update UI based on cart state (e.g., mark as added)
                        console.log("Product already in cart: " + product_title);
                        // Optionally, highlight the product or show quantity
                    }
                });
            }
        });
        function add_to_cart(CartEvent = "") {
            let products = [];
            if (localStorage.getItem('products')) {
                products = JSON.parse(localStorage.getItem('products'));
            }

            // Get product details
            const price = parseInt($('.price').attr("data-price"));
            const mrp_price = parseInt($('.mrp').attr("data-mrp"));
            const product_id = $('.product-title').attr("data-id");
            const product_title = $('.product-title').html();
            const discount_percentage = $('.discount').html();
            const discount_amount = (mrp_price - price);
            const product_img = $('.main_image').attr('src');
            const color = $('.color-item.active').find('span').text().trim();
            const storage = $('.dress-size.active').text(); // Get the selected size text

            let is_added_product = false;

            // Check if the product with the same color and storage already exists
            if (products.length > 0) {
                for (let index = 0; index < products.length; index++) {
                    // Check if the product already exists
                    if (products[index]['product_id'] === product_id &&
                        products[index]['color'] === color &&
                        products[index]['storage'] === storage) {
                        // If product exists, increase the quantity
                        products[index]['qty'] += 1;
                        is_added_product = true;
                        break;
                    }
                }
            }

            // If the product does not exist, add it as a new product
            if (!is_added_product) {
                products.push({
                    'index': products.length,
                    'product_id': product_id,
                    'product_title': product_title,
                    'discount_percentage': discount_percentage,
                    'discount_amount': discount_amount,
                    'product_img': product_img,
                    'color': color,
                    'storage': storage, // Ensure storage is included
                    'mrp': mrp_price,
                    'price': price,
                    'qty': 1
                });
            }

            // Save the updated products list to local storage
            localStorage.setItem('products', JSON.stringify(products));

            // Refresh the cart UI or perform any actions as needed
            CartList();

            // Redirect to cart if "Buy Now" is clicked
            if (CartEvent === "buyNow") {
                window.location.href = BASEURL + "cart";
            } else {
                openNav();
            }
        }

        function manage_storage_click(that, class_name) {
            $(".storage-item").removeClass("active");
            $("." + class_name).addClass("active");
            $(".mrp").text("₹" + that.attr("data-mrp")).attr("data-mrp", that.attr("data-mrp"));
            $(".price").text("₹" + that.attr("data-selling-price")).attr("data-price", that.attr("data-selling-price"));
        }

        function manage_size_click(that, class_name) {
            $(".dress-size").removeClass("active");
            that.addClass("active");
        }
    </script>
</div>
</div>
</div>
</div>
</div>


<div id="mySidenav" class="sidenav" style="right: -100%;">
    <div class="sidenav-div">
        <div class="drawer__title">
            <img src="https://static-assets-web.flixcart.com/batman-returns/batman-returns/p/images/logo_lite-cbb357.png"
                class="_31Y9yB logo-icon" style="width:auto;height:30px;">
            <h3 class="ui2-heading"><span><b>Your Cart</b></span></h3>
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        </div>
    </div>
    <div class="cart-products-list">
        <center style="margin-top: 25vh;margin-bottom:30vh"> <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                xmlns:xlink="http://www.w3.org/1999/xlink" width="110" height="110" x="0" y="0"
                viewBox="0 0 450.391 450.391" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                <g>
                    <path
                        d="M143.673 350.322c-25.969 0-47.02 21.052-47.02 47.02 0 25.969 21.052 47.02 47.02 47.02 25.969 0 47.02-21.052 47.02-47.02.001-25.968-21.051-47.02-47.02-47.02zm0 73.143c-14.427 0-26.122-11.695-26.122-26.122s11.695-26.122 26.122-26.122 26.122 11.695 26.122 26.122c.001 14.427-11.695 26.122-26.122 26.122zM342.204 350.322c-25.969 0-47.02 21.052-47.02 47.02 0 25.969 21.052 47.02 47.02 47.02s47.02-21.052 47.02-47.02c0-25.968-21.051-47.02-47.02-47.02zm0 73.143c-14.427 0-26.122-11.695-26.122-26.122s11.695-26.122 26.122-26.122 26.122 11.695 26.122 26.122c.001 14.427-11.695 26.122-26.122 26.122zM448.261 76.037a13.064 13.064 0 0 0-8.359-4.18L99.788 67.155 90.384 38.42C83.759 19.211 65.771 6.243 45.453 6.028H10.449C4.678 6.028 0 10.706 0 16.477s4.678 10.449 10.449 10.449h35.004a27.17 27.17 0 0 1 25.078 18.286l66.351 200.098-5.224 12.016a50.154 50.154 0 0 0 4.702 45.453 48.588 48.588 0 0 0 39.184 21.943h203.233c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449H175.543a26.646 26.646 0 0 1-21.943-12.539 28.733 28.733 0 0 1-2.612-25.078l4.18-9.404 219.951-22.988c24.16-2.661 44.034-20.233 49.633-43.886L449.83 84.917a8.882 8.882 0 0 0-1.569-8.88zm-43.885 109.191c-3.392 15.226-16.319 26.457-31.869 27.69l-217.339 22.465-48.588-147.33 320.261 4.702-22.465 92.473z"
                        fill="#cccccc" opacity="1" data-original="#cccccc" class=""></path>
                </g>
            </svg>
            <p style="font-size: 20px;font-weight: 600;color: #1a2024;margin-top:3rem;margin-bottom: 40px;">
                Your
                cart is feeling lonely</p>
            <div class="button-wrapper">
                <!-- <a href="#" class="btn btn-dark" style="border-radius: 10px!important;font-size: 16px;background-image: none;color: #fff;text-transform: capitalize;padding: 10px 16px;" onclick="closeNav()">Start shopping</a> -->
            </div>
        </center>
    </div>




    <div class="cart__footer" style="display: none;">
        <div class="cart__price__details">
            <div class="cart__breakup__inner">
                <div class="cart__total">
                    <span class="">Cart Total:</span>
                    <span class="cartTotalAmount">₹199.00</span>
                </div>
                <div class="shipping__total" style="border-bottom: 1px dashed #000;">
                    <span class="">Shipping:</span>
                    <span class="">FREE</span>
                </div>
                <div class="mc_pay__total">
                    <span class="">To Pay:</span>
                    <span class="cartTotalAmount">₹199.00</span>
                </div>
            </div>
        </div>
        <div class="cart__checkout">
            <div class="cart__final__payment">
                <h2 class="cart__final__price cartTotalAmount">₹199.00</h2>
                <p class="cart__tax__text">Inclusive of all taxes</p>
            </div>
            <a href="https://huntbars.shop/cart" class="confirm-order">Place Order</a>
        </div>
    </div>
</div>
</footer>

<script src="https://huntbars.shop/assets/website/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script>
    $(window).ready(function () {
        $(".itivvW").remove();
    });
    //  Cart Start ==================
    $(".custom_lazyload")
        .lazyload({
            effect: "fadeIn",
            threshold: 5000,
        })
        .removeClass("custom_lazyload");

    function openNav() {
        document.getElementById("mySidenav").style.right = "0";
        document.getElementById("overlay").style.display = "block";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.right = "-100%";
        document.getElementById("overlay").style.display = "none";
    }

    function CartList() {
        cart_html = "";
        products = [];
        cartTotalAmount = 0;

        if (localStorage.getItem('products')) {
            products = JSON.parse(localStorage.getItem('products'));
        }
        if (products.length > 0) {
            for (index = 0; index < products.length; index++) {

                qty = products[index]['qty'];
                cartTotalAmount += (products[index]['price'] * qty);

                product_qty = qty < 10 ? "0" + qty : qty;
                cart_html += '<div class="cart-product cart-product-index-' + products[index]['index'] + '">\
                                    <div class="cart-product-img">\
                                            <img src="' + products[index]['product_img'] + '" alt="">\
                                        </div>\
                                        <div class="cart-product-details">\
                                            <div class="cart-product-title">\
                                                <p>' + products[index]['product_title'] + '</p>\
                                                <img src="https://cdn.shopify.com/s/files/1/0057/8938/4802/files/Group_1_93145e45-8530-46aa-9fb8-6768cc3d80d2.png?v=1633783107" class="remove-cart-item" data-index="' + products[index]['index'] + '" alt="">\
                                            </div>\
                                            <div class="cart-product-pricing">\
                                                <p class="cart-product-price">₹' + products[index]['price'] + '</p>&nbsp;\
                                                <span class="cart-product-mrp">₹' + products[index]['mrp'] + '</span>\
                                            </div>\
                                                <div class="cart-product-description">\
                                                <p class="cart-product-size">Color :' + products[index]['color'] + '</p>\
                                                </div>\
                                            <div class="cart-product-description">\
                                                <p class="cart-product-size">Size/Storage :' + products[index]['storage'] + '</p>\
                                                <span class="sc-lbxAil evmCQI"></span>\
                                                \
                                                    <div class="cart-qty-wrapper">\
                                                        <span class="minus" data-index="' + products[index]['index'] + '">-</span>\
                                                        <span class="num">' + product_qty + '</span>\
                                                        <span class="plus" data-index="' + products[index]['index'] + '">+</span>\
                                                    </div>\
                                                \
                                            </div>\
                                        </div>\
                                    </div>';
            }
        }
        if (cart_html == "") {
            cart_html = ' <center style="margin-top: 25vh;margin-bottom:30vh">\
                               <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="110" height="110" x="0" y="0" viewBox="0 0 450.391 450.391" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M143.673 350.322c-25.969 0-47.02 21.052-47.02 47.02 0 25.969 21.052 47.02 47.02 47.02 25.969 0 47.02-21.052 47.02-47.02.001-25.968-21.051-47.02-47.02-47.02zm0 73.143c-14.427 0-26.122-11.695-26.122-26.122s11.695-26.122 26.122-26.122 26.122 11.695 26.122 26.122c.001 14.427-11.695 26.122-26.122 26.122zM342.204 350.322c-25.969 0-47.02 21.052-47.02 47.02 0 25.969 21.052 47.02 47.02 47.02s47.02-21.052 47.02-47.02c0-25.968-21.051-47.02-47.02-47.02zm0 73.143c-14.427 0-26.122-11.695-26.122-26.122s11.695-26.122 26.122-26.122 26.122 11.695 26.122 26.122c.001 14.427-11.695 26.122-26.122 26.122zM448.261 76.037a13.064 13.064 0 0 0-8.359-4.18L99.788 67.155 90.384 38.42C83.759 19.211 65.771 6.243 45.453 6.028H10.449C4.678 6.028 0 10.706 0 16.477s4.678 10.449 10.449 10.449h35.004a27.17 27.17 0 0 1 25.078 18.286l66.351 200.098-5.224 12.016a50.154 50.154 0 0 0 4.702 45.453 48.588 48.588 0 0 0 39.184 21.943h203.233c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449H175.543a26.646 26.646 0 0 1-21.943-12.539 28.733 28.733 0 0 1-2.612-25.078l4.18-9.404 219.951-22.988c24.16-2.661 44.034-20.233 49.633-43.886L449.83 84.917a8.882 8.882 0 0 0-1.569-8.88zm-43.885 109.191c-3.392 15.226-16.319 26.457-31.869 27.69l-217.339 22.465-48.588-147.33 320.261 4.702-22.465 92.473z" fill="#cccccc" opacity="1" data-original="#cccccc" class=""></path></g></svg>\
                                    <p style="font-size: 20px;font-weight: 600;color: #1a2024;margin-top:3rem;margin-bottom: 40px;">Your cart is feeling lonely</p>\
                                    <div class="button-wrapper">\
                                    <!-- <a href="#" class="btn btn-dark" style="border-radius: 10px!important;font-size: 16px;background-image: none;color: #fff;text-transform: capitalize;padding: 10px 16px;" onclick="closeNav()">Start shopping</a> --> </div></center>';
        }

        $(".cart-products-list").html(cart_html);

        if (cartTotalAmount > 0) {
            $(".cart__footer").show();
            $(".cartTotalAmount").html("₹" + cartTotalAmount.toFixed(2));

        } else {
            $(".cart__footer").hide();
        }
        localStorage.setItem('cartTotalAmount', cartTotalAmount.toFixed(2));

        //  Cart FFloating Item
        $(".header__cart-count--floating").html(products.length);
        if (products.length > 0) {
            $(".header__cart-count--floating").removeClass("d-none");
        } else {
            $(".header__cart-count--floating").addClass("d-none");
            if ("cart" == "product_details" || "payment" == "product_details") {
                window.location.href = "https://huntbars.shop/";
            }
        }
    }
    CartList();

    function removeCart(removeIndex) {
        CartProducts = [];

        if (localStorage.getItem('products')) {
            CartProducts = JSON.parse(localStorage.getItem('products'));
        }

        CartProducts.splice(removeIndex, 1);
        $(".cart-product-index-" + removeIndex).remove();

        for (index = 0; index < CartProducts.length; index++) {
            CartProducts[index]['index'] = index;
        }

        localStorage.setItem('products', JSON.stringify(CartProducts));
        CartList();
    }

    function updateCartQty(Index, newQty) {
        CartProducts = [];

        if (localStorage.getItem('products')) {
            CartProducts = JSON.parse(localStorage.getItem('products'));
        }

        for (let index = 0; index < CartProducts.length; index++) {
            if (CartProducts[index]['index'] == Index) {
                CartProducts[index]['qty'] = newQty;
            }
        }
        localStorage.setItem('products', JSON.stringify(CartProducts));
        CartList();
    }

    // Qty Add Minus start ===========
    $(document).ready(function () {
        // Cache jQuery selectors for performance
        const $plusButton = $(".plus");
        const $minusButton = $(".minus");
        const $numberDisplay = $(".num");

        // Initialize the counter

        // Function to update the display and handle formatting
        const updateDisplay = (that) => {
            const formattedCount = count < 10 ? "0" + count : count;
            that.text(formattedCount);
        };

        // Event listener for the plus button
        $(document).on("click", ".plus", function () {
            product_index = $(this).attr("data-index");
            $that = $(this).parent(".cart-qty-wrapper").find(".num");
            count = parseInt($that.text());
            count++;
            updateDisplay($that);
            updateCartQty(product_index, count);
        });

        // Event listener for the minus button
        $(document).on("click", ".minus", function () {
            product_index = $(this).attr("data-index");
            $that = $(this).parent(".cart-qty-wrapper").find(".num");
            count = parseInt($that.text());
            if (count > 1) {
                count--;
                updateDisplay($that);
                updateCartQty(product_index, count);
            } else {
                removeCart(product_index);
            }
        });


        $(document).on("click", ".remove-cart-item", function () {
            product_index = $(this).attr("data-index");
            removeCart(product_index);
        });
    });

    // Qty Add Minus End ===========
    //  Cart End  ==========================

    $("#back-btn").on("click", function () {
        history.back();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        var touchStartX = 0;
        var touchEndX = 0;
        var mouseDownX = 0;
        var isMouseDown = false;

        // Initialize the carousel with auto-scrolling
        $('#sliderX').carousel({
            interval: 2000, // Set the time interval for auto sliding (e.g., 2 seconds)
            ride: 'carousel', // Enable auto sliding on page load
        });

        // Handle touch start event to capture touch position
        $('#sliderX').on('touchstart', function (event) {
            touchStartX = event.changedTouches[0].screenX; // Get the initial touch position
        });

        // Handle touch end event to determine swipe direction
        $('#sliderX').on('touchend', function (event) {
            touchEndX = event.changedTouches[0].screenX; // Get the final touch position

            handleSwipe(); // Call the function to handle the swipe
        });

        // Handle mouse down event (when user clicks to start dragging)
        $('#sliderX').on('mousedown', function (event) {
            isMouseDown = true;
            mouseDownX = event.clientX; // Get the initial mouse position
        });

        // Handle mouse move event (when user drags the mouse)
        $('#sliderX').on('mousemove', function (event) {
            if (isMouseDown) {
                // Check if mouse is being dragged
                var mouseMoveX = event.clientX; // Get the current mouse position
                var deltaX = mouseMoveX - mouseDownX; // Calculate the difference in X position

                // Trigger swipe based on the direction of the drag
                if (deltaX > 50) {
                    // Dragged to the right, move to previous slide
                    $('#sliderX').carousel('prev');
                    isMouseDown = false; // End drag
                } else if (deltaX < -50) {
                    // Dragged to the left, move to next slide
                    $('#sliderX').carousel('next');
                    isMouseDown = false; // End drag
                }
            }
        });

        // Handle mouse up event (when user releases the mouse)
        $('#sliderX').on('mouseup', function () {
            isMouseDown = false; // End drag when mouse is released
        });

        // Handle touch swipe (same as before)
        function handleSwipe() {
            if (touchEndX < touchStartX) {
                // Swipe left
                $('#sliderX').carousel('next');
            }

            if (touchEndX > touchStartX) {
                // Swipe right
                $('#sliderX').carousel('prev');
            }
        }

        // Optionally, add an event listener to reset the auto scroll if the user manually scrolls
        $('#sliderX').on('slid.bs.carousel', function () {
            // Reset the auto-scroll interval after a manual slide
            $('#sliderX').carousel('cycle');
        });

    });
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function generateRandomOrderText() {
        const peopleOrdered = getRandomInt(500, 1000); // Random number of people (500-1000)

        // Randomly select a time period
        const timePeriods = [
            { text: 'day', range: [2, 30] },
            { text: 'week', range: [1, 4] },
            { text: 'month', range: [1, 3] }
        ];

        const selectedPeriod = timePeriods[getRandomInt(0, timePeriods.length - 1)];
        const periodValue = getRandomInt(selectedPeriod.range[0], selectedPeriod.range[1]);

        // Construct the final message
        let periodText = `${periodValue} ${selectedPeriod.text}${periodValue > 1 ? 's' : ''}`;

        document.getElementById('order-info').innerText = `${peopleOrdered} people ordered this in the last ${periodText}`;
    }

    // Call the function to display the random message
    generateRandomOrderText();

</script>

</body>

</html>