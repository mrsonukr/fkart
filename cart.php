
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
     <!-- Meta php common for all page -->
    <title>Cart</title>
</head>
<div class="loader-container">
    <div class="page-loader"></div>
</div>
<style>
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

    .page-loader {
        width: 32px;
        aspect-ratio: 1;
        border-radius: 50%;
        border: 3px solid #2874f0;
        animation:
            pl-1 0.8s infinite linear alternate,
            pl-2 1.6s infinite linear;
    }

    @keyframes pl-1 {
        0% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 50% 0%, 50% 0%, 50% 0%, 50% 0%)
        }

        12.5% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 0%, 100% 0%, 100% 0%)
        }

        25% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 100% 100%, 100% 100%)
        }

        50% {
            clip-path: polygon(50% 50%, 0 0, 50% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%)
        }

        62.5% {
            clip-path: polygon(50% 50%, 100% 0, 100% 0%, 100% 0%, 100% 100%, 50% 100%, 0% 100%)
        }

        75% {
            clip-path: polygon(50% 50%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 50% 100%, 0% 100%)
        }

        100% {
            clip-path: polygon(50% 50%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 50% 100%, 0% 100%)
        }
    }

    @keyframes pl-2 {
        0% {
            transform: scaleY(1) rotate(0deg)
        }

        49.99% {
            transform: scaleY(1) rotate(135deg)
        }

        50% {
            transform: scaleY(-1) rotate(0deg)
        }

        100% {
            transform: scaleY(-1) rotate(-135deg)
        }
    }
</style>
<script>
   // Immediately show the loader when the script runs
const loaderContainer = document.querySelector('.loader-container');

// Set a timeout of 2 seconds (2000 milliseconds) to hide and remove the loader
setTimeout(() => {
    loaderContainer.style.display = 'none'; // Hide the loader
    loaderContainer.remove(); // Remove it from the DOM
}, 1000); // 2000 milliseconds = 2 seconds
</script>
<body>
    <header>
    <nav>
        <div class="header-1">
            <div class="back-arrow" onclick="goToCart()">
                <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="black" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                </svg>
            </div>
            <div class="pagename">My Cart</div>
        </div>
        <br>
        <div class="header-2">
            <div class="back-arrow" onclick="goToCart()">
                <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="black" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                </svg>
            </div>
            <div class="pagename">My Cart</div>
        </div>
    </nav>
    <script>let lastScrollTop = 0; // Variable to track the last scroll position

// Function to detect scroll direction and toggle header visibility
window.onscroll = function () {
    toggleHeaderVisibility();
};

function toggleHeaderVisibility() {
    const header2 = document.querySelector('.header-2');
    const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Show header-2 when scrolling up, hide when scrolling down
    if (currentScrollTop < lastScrollTop) {
        header2.style.display = "flex"; // Show header-2 when scrolling up
    } else {
        header2.style.display = "none"; // Hide header-2 when scrolling down
    }

    lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop; // Update last scroll position
}

</script>
    </header>

    <script>
    function goToCart() {
        window.location.href = 'index.php';  // Redirect to cart.php
    }
</script>
    <div class="tab-content">
        <!-- Flipkart content -->
        <div id="cart-items"></div> 
        
    </div>

    <div class="tab-content" id="grocery" style="display: none;">
        <div class="grocery-tab">
            <div class="grocery-img">
                <img src="assets/images/img/grocery-emp.webp" alt="Grocery Image">
            </div>
            <div class="grocery-msg">Your basket is empty!</div>
            <div class="grocery-msg2">Enjoy Upto 50% Savings on Grocery</div>
            <div class="shop-now-btn">Shop Now</div>
        </div>
        
        <style>
            
           .grocery-tab {
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: center; /* Center children vertically, if needed */
            text-align: center; /* Center text inside the container */
        }
        
        .grocery-img img {
            margin-top: 48px;
            max-width: 161px;
            min-height: 148px;
        }
        
        .grocery-msg {
            color: rgb(17, 17, 18);
            margin-top: 32px;
            font-size: 22px;
            line-height: 30px;
            font-weight: 600;
            letter-spacing: -0.02px;
        }
        
        .grocery-msg2 {
            color: rgb(113, 116, 120);
            margin-top: 16px;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
            letter-spacing: -0.01px;
        }
        
        .shop-now-btn {
            color: rgb(255, 255, 255);
            margin-top: 32px;
            padding: 6px;
            background-color: rgb(42, 85, 229);
            border-radius: 4px;
            width: 160px;
            text-align: center; /* Center text within the button */
            cursor: pointer; /* Change cursor to pointer on hover */
        }
        
        </style>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function () {
    // Tab click functionality
    $(".tab-names div").on("click", function () {
        var tabId = $(this).data("tab");

        // Hide all tab content
        $(".tab-content").hide();

        // Show the clicked tab content
        $("#" + tabId).show();

        // Remove the 'active' class from all tabs and add it to the clicked tab
        $(".tab-names div").removeClass("active");
        $(this).addClass("active");

        // Change the URL without reloading the page
        history.pushState(null, '', '?tab=' + tabId);
    });

    // Get the active tab from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab') || 'flipkart'; // Default to 'flipkart'

    // Show the active tab and set it as active
    $(".tab-names div[data-tab='" + activeTab + "']").click();

    // Function to update the cart count in the "Flipkart" tab
    function updateCartCount() {
        let products = JSON.parse(localStorage.getItem('products')) || [];

        // Check if there are products in the cart
        if (products.length === 0) {
            $("#flipkart-tab").text("Flipkart"); // If empty, show only "Flipkart"
        } else {
            $("#flipkart-tab").text(`Flipkart (${products.length})`); // Show "Flipkart (x)"
        }
    }

    // Call the function to set the initial cart count when the document is ready
    updateCartCount();

    // Listen for visibility change (when the user returns to the page)
    document.addEventListener("visibilitychange", function () {
        if (!document.hidden) {
            updateCartCount();
        }
    });


            function formatNumberWithCommas(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            function CartList() {
    let cart_html = "";
    let products = JSON.parse(localStorage.getItem('products')) || [];
    let cartTotalAmount = 0;
    let totalMRP = 0;  // Variable to hold the total MRP of products
    let totalSellPrice = 0; // Variable to hold the total sell price of products
    let totalQty = 0;  // Variable to hold the total quantity of products
    let hasMobiles = false; // Flag to check if there are any "mobiles" category products

    if (products.length > 0) {
        // Add the delivery address section only once
        cart_html += ` <div id="addressesList">
            <!-- Addresses will be displayed here -->
        </div>
        `;
        for (let index = 0; index < products.length; index++) {
            let qty = products[index]['qty'];
            cartTotalAmount += (products[index]['price'] * qty);
            totalMRP += (products[index]['mrp'] * qty);  // Calculate total MRP
            totalSellPrice += (products[index]['price'] * qty);  // Calculate total sell price
            totalQty += qty;  // Add to the total quantity

            if (products[index]['category'] === 'mobiles') {
                hasMobiles = true; // Set flag if product is in the "mobiles" category
            }

            let product_qty = qty < 10 ? "0" + qty : qty;
            cart_html += `
            
        <div class="cartbox">
                <div class="cartlist">
                    <div class="left-side-box">
                        <div class="image-box">
                            <img src="${products[index]['product_img']}" alt="Image">
                        </div>
                         <div class="select-qty" data-product-id="${index}">
                            Qty: <span id="currentQty">${product_qty}</span> <img src="assets/images/svg/down.svg" alt="">
                         </div>
                    </div>
                    <div class="right-side-box">
                        <div class="product-name">${products[index]['product_title']}</div>
                        <div class="size-storage">Size: ${products[index]['storage']}</div>
                        <div class="rating">
                            <img src="assets/images/svg/${products[index]['rating_img']}" alt="">
                            <span class="rating-point">${products[index]['rating_point']}.0</span><span class="point">•</span><span class="total-rating">(${products[index]['total_rating']})</span>
                        </div>
                        <div class="off-arrow">
                            <img src="assets/images/svg/discount.svg" alt="">
                            <span class="discount">${Math.abs(parseFloat(products[index]['discount_percentage']))}%</span>
                           <span class="mrp-price">₹${formatNumberWithCommas(products[index]['mrp'])}</span>
<span class="sell-price">₹${formatNumberWithCommas(products[index]['price'])}</span>
                        </div>
                        <div class="offer">3 offers available</div>
                    </div>
                </div>
                <div class="delivery-date">
                    <img src="assets/images/svg/car.png" alt="">
                    <span class="exp">EXPRESS</span>
                    <span class="msg">${products[index]['delivery_message']}</span>
                    <span class="point">•</span>
                    <span class="charge">₹70</span>
                    <span class="free">FREE</span>
                </div>
            </div>
            <div class="action-box">
                <div class="sfl-btn">
                    <div class="sfl-icon">
                        <svg width="16" height="16" viewBox="0 0 256 256">
                            <path fill="none" d="M0 0h256v256H0z"></path>
                            <path d="M208 216H48a8 8 0 0 1-8-8V72l16-32h144l16 32v136a8 8 0 0 1-8 8Z" fill="none" stroke="#717478"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path>
                            <path fill="none" stroke="#717478" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"
                                d="M94.1 150.1L128 184l33.9-33.9M128 104v80M40 72h176"></path>
                        </svg>
                        <span>Save for later</span>
                    </div>
                </div>
                <div class="remove-btn" class="remove-icon" data-index="${index}">
                    <div class="remove-icon">
                        <svg width="16" height="16" viewBox="0 0 256 256">
                            <path fill="none" d="M0 0h256v256H0z"></path>
                            <path fill="none" stroke="#717478" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"
                                d="M216 56H40M104 104v64M152 104v64M200 56v152a8 8 0 0 1-8 8H64a8 8 0 0 1-8-8V56M168 56V40a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v16"></path>
                        </svg>
                        <span>Remove</span>
                    </div>
                </div>
            </div>
            <div id="qtyPopup" class="qty-popup">
                <div class="qty-options">
                    <button class="qty-option" data-qty="1">1</button>
                    <button class="qty-option" data-qty="2">2</button>
                    <button class="qty-option" data-qty="3">3</button>
                    <button class="qty-option" data-qty="4">more</button>
                </div>
            </div>
            <div class="space" style="height: 5px;"></div>
        `;
                    }

                    // Calculate the discount: total MRP - total Sell Price
                    let discount = totalMRP - cartTotalAmount;

                    // Delivery charges calculation: 40 * total quantity of all products
                    let deliveryCharges = 40 * totalQty;

                    // Add price details after looping through all the products
                    cart_html += `
                    <div class="safe-box-centre">
    <div class="safe-box">
        <div class="safe-img">
            <img src="assets/images/svg/secure.png"
                alt="">
        </div>
        <div class="safe-msg">Safe and secure payments. Easy returns. 100% Authentic products.</div>
    </div>
</div>

            <div class="price-details">
                <h1>Price Details</h1>
                <div class="ps-list">
                    <div>Price (${totalQty} items)</div>
                    <div>₹${formatNumberWithCommas(totalMRP)}</div>  <!-- Display total MRP -->
                </div>
                <div class="ps-list">
                    <div>Discount</div>
                    <div class="green">- ₹${formatNumberWithCommas(Math.abs(discount))}</div>  <!-- Display the calculated discount -->
                </div>
                <div class="ps-list">
                    <div>Delivery Charges</div>
                    <div><span class="over-line delivery-charges">₹${formatNumberWithCommas(deliveryCharges)}</span><span class="green">FREE Delivery</span></div>  <!-- Display delivery charges -->
                </div>
                ${hasMobiles ? `
                <div class="ps-list">
                    <div>Secured Packaging Fee</div>
                    <div>₹59</div>  <!-- Only show for mobiles category -->
                </div>
                ` : ''}
                <div class="zigzag-line"></div>
                <div class="ps-list bottom bold">
                    <div>Total Amount</div>
                    <div >₹${formatNumberWithCommas(cartTotalAmount + (hasMobiles ? 59 : 0))}</div> <!-- Add 59 to total if there are mobiles -->
                </div>
            </div>
            <div class="green offer-text bold">You will save ₹${formatNumberWithCommas(Math.abs(discount))} on this order</div>
            <div class="space" style="height: 10px;"></div>
            
   
           
<div class="check-box" id="check-box">
    <div class="cb-details">
        <div class="cb-mrp-price">${formatNumberWithCommas(totalMRP)}</div> <!-- Display total MRP here -->
        <div class="cb-sell-price">${formatNumberWithCommas(cartTotalAmount + (hasMobiles ? 59 : 0))} <!-- Use cartTotalAmount as the total sell price -->
            <span class="cb-info-ic">
                <img src="info-icon.svg" alt="">
            </span>
        </div> <!-- Display total sell price here -->
    </div>
    <div class="cb-btn">
        <a href="#" id=place-order-btn >Place Order</a>
    </div>
</div>

<div class="check-box2" id="check-box2" style="display: none;">
    <div class="cb-details">
        <div class="cb-mrp-price">${formatNumberWithCommas(totalMRP)}</div> <!-- Display total MRP here -->
                    <div class="cb-sell-price">${formatNumberWithCommas(cartTotalAmount + (hasMobiles ? 59 : 0))} <!-- Use cartTotalAmount as the total sell price -->
            <span class="cb-info-ic">
                <img src="info-icon.svg" alt="">
            </span>
        </div> <!-- Display total sell price here -->
    </div>
    <div class="cb-btn">
        <a href="#" id=place-order-btn2 >Place Order</a>
    </div>
</div>
        `;
                } else {
                    cart_html = ` <div class="emp-cart">
  <div id="lottie"></div>
</div>
<div class="emp-msg">Your cart is empty!</div>
`;
                }

                $("#cart-items").html(cart_html);

                // Load the Lottie animation
                lottie.loadAnimation({
                    container: document.getElementById('lottie'), // The container element
                    renderer: 'svg', // Renderer type: 'svg', 'canvas', or 'html'
                    loop: true, // Whether the animation should loop
                    autoplay: true, // Autoplay on load
                    path: 'assets/json/animation.json' // Path to your Lottie JSON file
                });


                // Update total cart amount
                if (cartTotalAmount > 0) {
                    $("#cartTotalAmount").html(`₹${cartTotalAmount.toFixed(2)}`);
                } else {
                    $("#cartTotalAmount").html(`₹0.00`);
                }

                // Remove product from cart
                $(".remove-icon").on("click", function () {
                    let index = $(this).data("index");
                    products.splice(index, 1);
                    localStorage.setItem("products", JSON.stringify(products));
                    CartList();  // Reload the cart after removal
                });
                // Add event listeners for quantity selection
                $(".select-qty").on("click", function (event) {
                    event.stopPropagation();
                    const rect = this.getBoundingClientRect();
                    const popup = $("#qtyPopup");
                    popup.css({
                        left: `${rect.left}px`,
                        top: `${rect.bottom + window.scrollY}px`,
                        width: `${rect.width}px`
                    }).show();
                    popup.attr("data-active-product", $(this).data("product-id"));
                });

                // Handle the quantity selection
                $(".qty-option").off("click").on("click", function () {
                    const selectedQty = $(this).data("qty");
                    const activeProductId = $("#qtyPopup").data("active-product");
                    const activeQtyBox = $(`.select-qty[data-product-id="${activeProductId}"] #currentQty`);
                    if (selectedQty) {
                        activeQtyBox.text(selectedQty);
                        products[activeProductId].qty = selectedQty; // Update the quantity in local storage
                        localStorage.setItem("products", JSON.stringify(products));
                        CartList(); // Refresh the cart
                    }
                    $("#qtyPopup").hide(); // Close the popup
                });

                // Close the popup when clicking outside
                $(window).on("click", function (event) {
                    if (!$("#qtyPopup").is(event.target) && $("#qtyPopup").has(event.target).length === 0) {
                        $("#qtyPopup").hide();
                    }
                });
                // Attach the event listener to the place order button
            document.getElementById('place-order-btn').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default anchor behavior

                // Check if an address is available
                var addressAvailable = checkAddressAvailability(); // Call the function to check address availability

                if (addressAvailable) {
                    window.location.href = 'summary.php'; // Redirect to summary.php if address is available
                } else {
                    window.location.href = 'address.php?redirect=next'; // Redirect to address.php if no address is available
                }
            });// Attach the event listener to the place order button
            document.getElementById('place-order-btn2').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default anchor behavior

                // Check if an address is available
                var addressAvailable = checkAddressAvailability(); // Call the function to check address availability

                if (addressAvailable) {
                    window.location.href = 'summary.php'; // Redirect to summary.php if address is available
                } else {
                    window.location.href = 'address.php?redirect=next'; // Redirect to address.php if no address is available
                }
            });
            }

            // Call the function to load and display the cart items
            CartList();
        });

    </script>

<script>
    window.onload = function() {
        // Retrieve saved addresses from localStorage
        let addresses = JSON.parse(localStorage.getItem('addresses')) || [];

        // Get the address container
        let addressContainer = document.getElementById("addressesList");

        // Check if there are any addresses
        if (addresses.length > 0) {
            // Get the first address
            let address = addresses[0]; // Access the first address directly

            // Create an HTML element to display the first address
            let addressDiv = document.createElement('div');
            addressDiv.classList.add('address-item');
            addressDiv.innerHTML = `
            <div class="add-lr">
                <div class="add-box">
                    <div class="address">Deliver To: <span class="bold customer-name">${address.name}, ${address.pin}</span> <span class="add-type">${address.addressType}</span></div>
                    <div class="full-add">${address.flat}, ${address.area}, ${address.city}, ${address.state}</div>
                </div>
                <div>
                    <button>Change</button>
                </div>
            </div>
            `;
            addressContainer.appendChild(addressDiv);
        } else {
            // If no addresses exist in localStorage, show a message
            addressContainer.innerHTML = `<div class="add-lr">
                <div class="add-box">
                    <div class="address">Deliver To: <span class="bold customer-name">India</span></div>
                    <div class="full-add">No Address Saved</div>
                </div>
                <div>
                   <button onclick="redirectToAddress()">Add</button>
                </div>
            </div>`;
        }
    };
    function redirectToAddress() {
    window.location.href = 'address.php?redirect=cart';
}
</script>

<script>
    document.getElementById('place-order-btn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        // Check if an address is available
        var addressAvailable = checkAddressAvailability(); // Call the function to check address availability

        if (addressAvailable) {
            window.location.href = 'summary.php'; // Redirect to summary.php if address is available
        } else {
            window.location.href = 'address.php?redirect=next'; // Redirect to address.php if no address is available
        }
    });

    function checkAddressAvailability() {
        // Retrieve saved addresses from localStorage
        let addresses = JSON.parse(localStorage.getItem('addresses')) || [];
        return addresses.length > 0; // Return true if there are addresses, false otherwise
    }
</script>
<script>
    document.getElementById('place-order-btn2').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        // Check if an address is available
        var addressAvailable = checkAddressAvailability(); // Call the function to check address availability

        if (addressAvailable) {
            window.location.href = 'summary.php'; // Redirect to summary.php if address is available
        } else {
            window.location.href = 'address.php?redirect=next'; // Redirect to address.php if no address is available
        }
    });

    function checkAddressAvailability() {
        // Retrieve saved addresses from localStorage
        let addresses = JSON.parse(localStorage.getItem('addresses')) || [];
        return addresses.length > 0; // Return true if there are addresses, false otherwise
    }
</script>

</body>

<style>
    .emp-msg {
        color: rgb(17, 17, 18);
        font-size: 22px;
        font-weight: 500;
        letter-spacing: -0.02px;
        text-align: center;
        margin-bottom: 20px;
        margin-top: -10px;
    }

    .emp-cart {
        display: flex;
        justify-content: center;
    }

    #lottie {
        width: 250px;
        height: 200px;
    }

    .qty-popup {
        display: none;
        /* Hidden by default */
        position: absolute;
        /* Positioned relative to the Qty box */
        background-color: white;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        z-index: 1000;
    }

    /* Quantity buttons */
    .qty-options {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .qty-option {
        color: black;
        width: 100%;
        padding: 2.6px 25px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        background-color: #ffffff;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .qty-option:hover {
        background-color: #ddd;
    }

    /* Style for the 'Qty' box */
    .select-qty {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .select-qty span {
        margin-right: 5px;
    }
    .safe-box-centre{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding: 0px 70px;
        margin-bottom: 10px;
    }
    .safe-box {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .safe-img img {
        width: 26px;
        margin-right: 10px;
    }

    .safe-msg {
        color: rgb(113, 116, 120);

        font-size: 12px;
        line-height: 18px;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        /* Ensure the font is correctly referenced */
        letter-spacing: 0px;
    }
</style>
<script>
    // Get the popup
    const popup = document.getElementById("qtyPopup");

    // Add event listeners to all quantity selectors
    const qtySelectors = document.querySelectorAll(".select-qty");

    qtySelectors.forEach((qtySelect) => {
        qtySelect.addEventListener("click", function (event) {
            event.stopPropagation();

            // Get the position and size of the clicked Qty box
            const rect = this.getBoundingClientRect();

            // Position the popup to cover the clicked Qty box
            popup.style.left = `${rect.left}px`;
            popup.style.top = `${rect.top}px`;
            popup.style.width = `${rect.width}px`;
            popup.style.display = "block";

            // Store the reference to the clicked Qty box
            popup.setAttribute("data-active-product", this.dataset.productId);
        });
    });

    // Handle the quantity selection
    const qtyOptions = document.querySelectorAll(".qty-option");
    qtyOptions.forEach((button) => {
        button.addEventListener("click", function () {
            const selectedQty = this.getAttribute("data-qty");
            const activeProductId = popup.getAttribute("data-active-product");

            // Find the corresponding quantity display and update it
            const activeQtyBox = document.querySelector(
                `.select-qty[data-product-id="${activeProductId}"] .currentQty`
            );

            if (selectedQty === "more") {
                alert("You selected more. You can enter the custom quantity.");
            } else if (activeQtyBox) {
                activeQtyBox.textContent = selectedQty;
            }

            // Close the popup after selection
            popup.style.display = "none";
        });
    });

    // Close the popup when clicking outside
    window.addEventListener("click", function (event) {
        if (!popup.contains(event.target)) {
            popup.style.display = "none";
        }
    });
</script>
<script>
    window.onscroll = function() {
        var checkBox = document.getElementById("check-box");
        var checkBox2 = document.getElementById("check-box2");

        // Get the position of the check-box
        var rect = checkBox.getBoundingClientRect();

        // Check if the check-box is above the bottom of the viewport
        if (rect.bottom < window.innerHeight) {
            checkBox2.style.display = "none"; // Hide check-box2
        } else {
            checkBox2.style.display = "flex"; // Show check-box2
        }
    };
</script>
</html>
