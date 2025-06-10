<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Summary</title>
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

        .process-bar {
            display: flex;
            justify-content: center;
            border-top: 1px solid #ccc;
            background-color: #ffffff;
            padding: 10px;
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
        window.onscroll = function () {
            var navbar = document.getElementById("navbar");
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                navbar.style.backgroundColor = "#f1f1f1"; // Change color on scroll
            } else {
                navbar.style.backgroundColor = "white"; // Original color
            }
        };

    </script>
</head>

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
            <div class="pagename">Order Summary</div>
        </div>
        <br>
        <div class="header-2">
            <div class="back-arrow" onclick="goToCart()">
                <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="black" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                </svg>
            </div>
            <div class="pagename">Order Summary</div>
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

function goToCart() {
    window.location.href = 'cart.php';  // Redirect to cart.php
}
</script>
        <div class="process-bar">
            <img src="assets/images/svg/p2.svg" alt="">
        </div>
    </header>


    <div class="tab-content">
        <!-- Flipkart content -->

        <div id="cart-items"></div> <!-- Dynamic cart content will go here -->
    </div>

    <div class="tab-content" id="grocery" style="display: none;">
        <div class="grocery-tab">
            <div class="grocery-img">
                <img src="ic/grocery-emp.webp" alt="Grocery Image">
            </div>
            <div class="grocery-msg">Your basket is empty!</div>
            <div class="grocery-msg2">Enjoy Upto 50% Savings on Grocery</div>
            <div class="shop-now-btn">Shop Now</div>
        </div>
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
            
            <div id="qtyPopup" class="qty-popup">
                <div class="qty-options">
                    <button class="qty-option" data-qty="1">1</button>
                    <button class="qty-option" data-qty="2">2</button>
                    <button class="qty-option" data-qty="3">3</button>
                    <button class="qty-option" data-qty="4">more</button>
                </div>
            </div>
            
        `;
                    }

                    // Calculate the discount: total MRP - total Sell Price
                    let discount = totalMRP - cartTotalAmount;

                    // Delivery charges calculation: 40 * total quantity of all products
                    let deliveryCharges = 40 * totalQty;

                    // Add price details after looping through all the products
                    cart_html += `
                    <div class="space" style="height: 10px;"></div>
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
            
   
            <div class="check-box">
                <div class="cb-details">
                    <div class="cb-mrp-price">${formatNumberWithCommas(totalMRP)}</div> <!-- Display total MRP here -->
                    <div class="cb-sell-price">${formatNumberWithCommas(cartTotalAmount + (hasMobiles ? 59 : 0))} <!-- Use cartTotalAmount as the total sell price -->
                        <span class="cb-info-ic">
                            <img src="assets/images/svg/info-icon.svg" alt="">
                        </span>
                    </div> <!-- Display total sell price here -->
                </div>
                <div class="cb-btn">
                    <a href="payment.php">Continue</a>
                </div>
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
                    path: 'animation.json' // Path to your Lottie JSON file
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
            }

            // Call the function to load and display the cart items
            CartList();
        });

    </script>
    <script>
        window.onload = function () {
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
                <div class="space" style="height: 5px;"></div>
                <div class="main-box-add">
                    <div class="add-box2">
                        <div class="left-side2">
                            <div class="cust-name">Deliver to:</div>
                            <div>
                                <span>${address.name}</span>
                                <span class="add-type">${address.addressType}</span>
                            </div>
                        </div>
                        <div class="change-btn">
                            <button>Change</button>
                        </div>
                    </div>
                    <div class="full-add2">${address.flat}, ${address.area}, ${address.city}, ${address.state} - ${address.pin}</div>
                    <div class="mobile-num">${address.number}</div>
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
            window.location.href = 'address.php';
        }

    </script>
</body>

<style>
    .main-box-add {
        background-color: #ffffff;
        padding: 10px;
        padding-left: 16px;


        font-size: 14px;
        margin-top: 2px;
    }

    .add-box2 {
        display: flex;
        justify-content: space-between;
    }

    .change-btn button {
        overflow: hidden;
        display: flex;
        margin-top: 2px;
        width: auto;
        padding: 10px 19px;
        margin-right: 10px;
        margin-left: -5px;
        color: #005bed;
        font-weight: 700;
        font-size: 12px;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        border-radius: 3px;
    }

    .cust-name {
        margin-top: 5px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .full-add2 {
        margin-top: 10px;
        color: #000000;
        font-size: 12px;
    }

    .mobile-num {
        margin-top: 5px;
        color: #000000;
        font-size: 12px;
    }


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

    .safe-box-centre {
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

</html>