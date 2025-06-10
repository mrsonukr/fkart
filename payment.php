<!DOCTYPE html>
<html lang="en">
<script src="assets/js/pay.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Payment</title>
    <link rel="stylesheet" href="assets/css/pay.css">
</head>

<script>
    // Add event listener for scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 0) {
            header.classList.add('header-scrolled'); // Add class when scrolled
        } else {
            header.classList.remove('header-scrolled'); // Remove class when at the top
        }
    });

    function toggleDetails() {
        const details = document.getElementById('details');
        const arrowImage = document.getElementById('arrowImage');

        if (details.classList.contains('open')) {
            // Collapse the details
            details.style.height = details.scrollHeight + 'px';
            requestAnimationFrame(() => {
                details.style.height = '0'; // Then collapse to 0
            });
            details.classList.remove('open');
            arrowImage.classList.remove('arrow-up');
            arrowImage.classList.add('arrow-down');
        } else {
            // Expand the details
            details.classList.add('open');
            details.style.height = details.scrollHeight + 'px'; // Expand to full height
            requestAnimationFrame(() => {
                details.style.height = details.scrollHeight + 'px'; // Set the height to scrollHeight for animation
            });
            arrowImage.classList.remove('arrow-down');
            arrowImage.classList.add('arrow-up');

            // Force reflow to trigger the transition
            details.offsetHeight; // This line forces a reflow
        }
    }

    // Add event listener to the header
    document.addEventListener('DOMContentLoaded', () => {
        const header = document.getElementById('header1');
        header.addEventListener('click', toggleDetails);
         // Add event listener for the back button
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    });

</script>

<scri id="summaryContainer"></div>

<script>
    
function CartList() {
    let upiId = 'merchant@upi';  // Replace with your UPI ID
    let merchantName = 'Merchant Name';  // Replace with your merchant name
    let tr = 'hello';
    let mc =  'hi';
    let products = JSON.parse(localStorage.getItem('products')) || [];
    let totalSellPrice = 0;
    let totalQuantity = 0;
    let showPackagingCharges = false;
    const packagingCharge = 50;

    // Get the URL parameter for product_url
    const urlParams = new URLSearchParams(window.location.search);
    const productUrlParam = urlParams.get('product_url');

    let filteredProducts = products;

    // If a specific product_url is provided, show only that product
    if (productUrlParam) {
        filteredProducts = products.filter(product => product.product_url === productUrlParam);

        if (filteredProducts.length > 0) {
            // Set totalSellPrice for a single quantity
            const singleProduct = filteredProducts[0];
            totalSellPrice = singleProduct.price;
            totalQuantity = 1; // Show single quantity
            
            // Check if the product category is "mobiles" to apply packaging charges
            if (singleProduct.category === "mobiles") {
                showPackagingCharges = true;
                totalSellPrice += packagingCharge; // Add packaging charges
            }
        } else {
            // No product found, show empty state
            document.getElementById('cartSummary').innerHTML = `
                <div class="cart-summary">
                    <h3>No product found for the given URL.</h3>
                </div>
            `;
            return;
        }
    } else {
        // Show all products and calculate total price and quantity
        filteredProducts.forEach(product => {
            totalSellPrice += product.price * product.qty;
            totalQuantity += product.qty;

            if (product.category === "mobiles") {
                showPackagingCharges = true;
            }
        });

        if (showPackagingCharges) {
            totalSellPrice += packagingCharge;
        }
    }

    // Create the HTML structure as a string
    const summaryHTML = `
        <header>
    <nav class="navbar">
        <div class="navbar-header">
            <div id="backButton">
    <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="black" stroke-width="1.5" 
            stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
    </svg>
</div>
            <div class="page-title">
                <div class="step-text">Step 3 of 3</div>
                <span style="font-weight: 600; color: #212121; margin-left: 20px;">Payments</span>
            </div>
        </div>
        <div class="secure-info">
            <img src="assets/images/svg/lock-icon.svg">
            <span class="secure-text">100% Secure</span>
        </div>
    </nav>
    <div class="summary">
        <div class="total-amount">
            <div class="details" id="details">
                <div class="detail-item">
                    <span>Price (${totalQuantity} items)</span>
                    <span>₹${formatNumberWithCommas(totalSellPrice)}</span>
                </div>
                <div class="detail-item">
                    <span>Delivery Charges</span>
                    <span class="free">FREE</span>
                </div>
                ${showPackagingCharges ? `
                    <div class="detail-item">
                        <span>Packaging Charges</span>
                        <span>₹59</span>
                    </div>
                    ` : ''}
                <div class="dash-border"></div>
            </div>
            <div class="header1" id="header1">
                <span>Total Amount<span class="arrow" id="arrow">
                        <svg class="arrow-down" width="7" height="14" viewBox="0 0 5 9" fill="none"
                            data-testid="chevron" id="arrowImage">
                            <path d="M1 8L4.5 4.5" stroke="#2A55E5" stroke-linecap="round"></path>
                            <path d="M1 1L4.5 4.5" stroke="#2A55E5" stroke-linecap="round"></path>
                        </svg>
                    </span></span>
                <span class="amount">₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</span>
            </div>
        </div>
    </div>
    <br>
</header>
<body>   
<main>
    <div class="bb-right">
        <div class="bb-left">
            <span id="text" class="gradient-text flashing-animation"
                style="animation-duration: 2s; animation-timing-function: ease; background-image: linear-gradient(to right, rgb(14, 119, 45) 8px, rgb(0, 255, 76) 16px, rgb(14, 119, 45) 24px);">
                <span class="font-m-semibold">10% instant discount</span>
            </span>
            <div class="claim-text">
                Claim now with payment offers
            </div>
        </div>
        <div class="bb-imgs">
            <img src="assets/images/svg/imgs.svg" alt="">
        </div>
    </div>
</main>

<div class="dropdown-container">
    <div onclick="toggleDropdown('dropdownContentUPI', 'dropdownArrowUPI', 'payTextUPI', this)">
        <div class="dropdown-header">
            <div class="left-section">
                <img src="assets/images/svg/upi.svg"
                    alt="UPI Payment Icon">
                <div class="text-container">
                    <span class="main-text">UPI</span>
                </div>
            </div>
            <div class="right-section">
                <img id="dropdownArrowUPI"
                    src="assets/images/svg/DownArrow.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextUPI">Pay by any UPI app</span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentUPI">
        <!-- inside menu -->
        <div class="upi-box">


            <!-- PhonePe Section -->
            <div class="select-box" onclick="selectPaymentOption('phonePe')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="phonePe" class="radio"
                                onchange="togglePayButton(this)" checked>
                            <label for="phonePe" class="checkbox-label">Phone Pe</label>
                        </div>
                        <img src="assets/images/svg/phonepe.svg"
                            alt="Phone Pe Logo" class="app-logo">
                    </div>
                    <div class="right-side" id="rightSidePhonePe">
                       <button class="pay-link" id="payButtonPhonePe" onclick="window.location.href='phonepe://pay?pa=${encodeURIComponent(upiId)}&pn=${encodeURIComponent(merchantName)}&am=${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}&tr=${encodeURIComponent(tr)}&cu=INR&mc=${encodeURIComponent(mc)}&qrMedium=04&tn=PaymenttoPRODUCTS'">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Paytm Section -->
            <div class="select-box" onclick="selectPaymentOption('paytm')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="paytm" class="radio"
                                onchange="togglePayButton(this)">
                            <label for="paytm" class="checkbox-label">Paytm</label>
                        </div>
                        <img src="assets/images/svg/paytm-icon.svg" alt="Paytm Logo" class="app-logo">
                    </div>
                    <div class="right-side" id="rightSidePaytm">
                        
                        <button class="pay-link" id="payButtonPaytm"onclick="window.location.href='paytmmp://pay?pa=${encodeURIComponent(upiId)}&pn=${encodeURIComponent(merchantName)}&am=${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}&tr=${encodeURIComponent(tr)}&cu=INR&mc=${encodeURIComponent(mc)}&qrMedium=04&tn=PaymenttoPRODUCTS'">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
            <hr>
                 
<!-- gpay -->
<div class="select-box" onclick="selectPaymentOption('g-pay')">
    <div class="top-side">
        <div class="gpay">
            <div class="checkbox-container">
                <input type="radio" name="paymentOption" id="g-pay" class="radio"
                    onchange="togglePayButton(this)">
                <label for="g-pay" class="checkbox-label">Google Pay</label>
            </div>
            <img src="assets/images/svg/gpay.svg" alt="Paytm Logo" class="app-logo">
        </div>
        <div class="right-side" id="rightSideg-pay">
            
            <button class="pay-link" id="payButtong-pay"onclick="window.location.href='tez://pay?pa=${encodeURIComponent(upiId)}&pn=${encodeURIComponent(merchantName)}&am=${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}&tr=${encodeURIComponent(tr)}&cu=INR&mc=${encodeURIComponent(mc)}&qrMedium=04&tn=PaymenttoPRODUCTS'">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
        </div>
    </div>
</div>
<hr>
            <!-- Google Pay Section -->
            <div class="select-box" onclick="selectPaymentOption('googlePay')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="googlePay" class="radio"
                                onchange="togglePayButton(this)">
                            <label for="googlePay" class="checkbox-label">Add New UPI ID</label>
                        </div>
                        <a class="blue bold font12 " href="">How to find?</a>
                    </div>
                    <div class="right-side active" id="rightSideGoogle">
                        <div class="margin-left" id="rightSideoogle">
                            <label for="card-number" class="gray font12">UPI ID</label>
                            <div class="upi-container">
                                <input type="text" id="upiId" placeholder="Enter your UPI ID" class="upi-input" />
                                <button type="button" class="verify-btn" onclick="verifyUpi()">
                                    <span class="btn-text">Verify</span>
                                    <div class="btn-loader"></div>
                                </button>
                            </div>
                            <p id="error-message">Invalid UPI ID</p>
                            <p id="fetch-error">Unable to fetch</p>
                            <br>
                            <button class="btn-submit-none">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- inside menu end -->
    </div>
</div>
<div class="dropdown-container">
    <div onclick="toggleDropdown('dropdownContentCard', 'dropdownArrowCard', 'payTextCard', this)">
        <div class="dropdown-header">
            <div class="left-section">
                <img src="assets/images/svg/card.svg"
                    alt="Card Payment Icon">
                <div class="text-container">
                    <span class="main-text">Credit / Debit / ATM Card</span>
                </div>
            </div>
            <div class="right-section">
                <img id="dropdownArrowCard"
                    src="assets/images/svg/DownArrow.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>


        <div class="subtext" id="payTextCard"><span class="p-subtext"><span class="gray colo">Add and secure cards
                    as per RBI guidelines</span><br>5% Unlimited Cashback on Flipkart Axis
                Bank Credit Card</span></div>

    </div>

    <div class="dropdown-content" id="dropdownContentCard">
        <!-- inside menu -->
        <div class="card-note">
            <div>
                <p><strong><em>Note:</em></strong> Please ensure your card can be used for online transactions.
                    Learn more</p>
            </div>
        </div>
        <div class="form-container">
            <form id="paymentForm">
                <div class="form-group" id="cardNumberGroup">
                    <label for="card-number" class="form-label">Card Number</label>
                    <div class="input-wrapper">
                        <input id="card-number" type="text" class="input-field" placeholder="XXXX XXXX XXXX"
                            maxlength="14">
                        <img src="https://static-assets-web.flixcart.com/fk-p-linchpin-web/fk-gringotts/p/img/dummy-card.svg"
                            alt="Card Icon" class="input-icon">
                    </div>
                    <span class="error-text">Card number is required</span>
                </div>

                <div class="form-row">
                    <div class="form-group" id="expiryDateGroup">
                        <label for="expiry-date" class="form-label">Valid Thru</label>
                        <div class="input-wrapper">
                            <input id="expiry-date" type="text" class="input-field" placeholder="MM / YY"
                                maxlength="7">
                        </div>
                        <span class="error-text">Enter valid month/year</span>
                    </div>
                    <div class="form-group" id="cvvGroup">
                        <label for="cvv" class="form-label">CVV</label>
                        <div class="input-wrapper">
                            <input id="cvv" type="text" class="input-field" placeholder="CVV" maxlength="3">
                            <img style="width: 18px;"
                                src="assets/images/svg/help-icon-black.svg"
                                alt="Help Icon" class="input-icon">
                        </div>
                        <span class="error-text">CVV required</span>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
            </form>
        </div><br>
        <!-- inside menu end -->
    </div>
</div>
<!-- Additional dropdowns for bank, card, wallet, and cash on delivery -->
<div class="dropdown-container">
    <div onclick="toggleDropdown('dropdownContentBank', 'dropdownArrowBank', 'payTextBank', this)">
        <div class="dropdown-header">
            <div class="left-section">
                <img src="assets/images/svg/net-banking-08092023.svg"
                    alt="Bank Payment Icon">
                <div class="text-container">
                    <span class="main-text">Net Banking</span>
                </div>
            </div>
            <div class="right-section">
                <img id="dropdownArrowBank"
                    src="assets/images/svg/DownArrow.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext-hide"><span class="p-subtext" id="payTextBank">Pay using your wallet</span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentBank">
        <!-- inside menu -->
        <div class="upi-box">
            <!-- HDFC Bank Section -->
            <div class="select-box" onclick="selectPaymentOption('hdfc')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="hdfc" class="radio"
                                onchange="togglePayButton(this)" checked>
                            <label for="hdfc" class="checkbox-label">HDFC Bank</label>
                        </div>
                        <img src="assets/images/svg/HDFC.svg"
                            alt="HDFC Bank Logo" class="app-logo">
                    </div>
                    <div class="right-side active" id="rightSidehdfc">
                        <button class="pay-link" id="payButtonhdfc">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
            <hr>

            <!-- ICICI Section -->
            <div class="select-box" onclick="selectPaymentOption('icici')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="icici" class="radio"
                                onchange="togglePayButton(this)">
                            <label for="icici" class="checkbox-label">ICICI Bank</label>
                        </div>
                        <img src="assets/images/svg/ICICI.svg"
                            alt="ICICI Bank Logo" class="app-logo">
                    </div>
                    <div class="right-side" id="rightSideicici">
                        <button class="pay-link" id="payButtonicici">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
            <hr>

            <!-- SBI Section -->
            <div class="select-box" onclick="selectPaymentOption('sbi')">
                <div class="top-side">
                    <div class="gpay">
                        <div class="checkbox-container">
                            <input type="radio" name="paymentOption" id="sbi" class="radio"
                                onchange="togglePayButton(this)">
                            <label for="sbi" class="checkbox-label">State Bank Of India</label>
                        </div>
                        <img src="assets/images/svg/SBI.svg"
                            alt="SBI Logo" class="app-logo">
                    </div>
                    <div class="right-side" id="rightSidesbi">
                        <button class="pay-link" id="payButtonsbi">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
            <!-- more banks -->
            <hr>
            <div class="select-box">
                <div class="top-side">
                    <div class="gpay">
                        <div>
                            <label for="sbi" class="blue bold all-bank">All other banks</label>
                        </div>

                    </div>
                    <div class="right-side" id="rightSidesbi">
                        <button class="pay-link" id="payButtonsbi">Pay ₹${formatNumberWithCommas(totalSellPrice + (showPackagingCharges ? 59 : 0))}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- inside menu end -->
    </div>
</div>

<div class="dropdown-container">
    <div >
        <div class="dropdown-header">
            <div class="left-section">
                <img src="assets/images/svg/wallet-logo.svg"
                    alt="Wallet Payment Icon">
                <div class="text-container">
                    <span class="main-text">Wallets</span>
                </div>
            </div>
            <div class="right-section">
                <img id="dropdownArrowWallet"
                    src="assets/images/svg/DownArrow.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextWallet"></span></div>
    </div>
    <div>
       
    </div>
</div>
<div class="dropdown-container">
    <div>
        <div class="dropdown-header">
            <div class="left-section">
                <img src="assets/images/svg/gift-card-logo-09082023.svg"
                    alt="Cash on Delivery Icon">
                <div class="text-container">
                    <span class="main-text">Have a Flipkart Gift Card?</span>
                </div>
            </div>
            <div class="right-section">
                <span class="blue bold font12">Add</span>
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextCOD"></span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentCOD">

    </div>
</div>
<div class="dropdown-container">
    <div>
        <div class="dropdown-header">
            <div class="left-section out">
                <img src="assets/images/svg/cash-icon.svg"
                    alt="Cash on Delivery Icon">
                <div class="text-container">
                    <span class="main-text">Cash on Delivery</span>
                </div>
            </div>
            <div class="right-section">
                <span class="bold font12 out">Unavailable&nbsp;</span>
                <img id="dropdownArrowCOD"
                    src="assets/images/svg/help-icon-grey.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextCOD"></span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentCOD">

    </div>
</div>
<div class="dropdown-container">
    <div>
        <div class="dropdown-header">
            <div class="left-section out">
                <img src="assets/images/svg/bnpl-icon-23082023.svg"
                    alt="Cash on Delivery Icon">
                <div class="text-container">
                    <span class="main-text">Flipkart EMI</span>
                </div>
            </div>
            <div class="right-section">
                <span class="bold font12 out">Unavailable&nbsp;</span>
                <img id="dropdownArrowCOD"
                    src="assets/images/svg/help-icon-grey.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextCOD"></span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentCOD">

    </div>
</div>
<div class="dropdown-container">
    <div>
        <div class="dropdown-header">
            <div class="left-section out">
                <img src="assets/images/svg/emi-header-08092023.svg"
                    alt="Cash on Delivery Icon">
                <div class="text-container">
                    <span class="main-text">EMI</span>
                </div>
            </div>
            <div class="right-section">
                <span class="bold font12 out">Unavailable&nbsp;</span>
                <img id="dropdownArrowCOD"
                    src="assets/images/svg/help-icon-grey.svg"
                    alt="Dropdown Arrow">
            </div>
        </div>
        <div class="subtext"><span class="p-subtext" id="payTextCOD"></span></div>
    </div>
    <div class="dropdown-content" id="dropdownContentCOD">

    </div>
</div>

<section class="happy-box">
    <div class="semibold-gray">35 Crore happy customers and counting!</div>
    <div class="ybR9AW flex-center OG2uvA _1uuTAs"><img
            src="assets/images/svg/smiley.svg" class="">
    </div>
</section>
        `;
        

        // Insert the HTML into the summaryContainer
        document.getElementById('summaryContainer').innerHTML = summaryHTML;
    }

    function formatNumberWithCommas(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    // Call CartList on page load
    CartList();

    // New code for card number and expiry date input handling
    const cardNumberInput = document.getElementById('card-number');
    const expiryDateInput = document.getElementById('expiry-date');

    cardNumberInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '').substring(0, 12);
        value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
        e.target.value = value.trim();
    });

    expiryDateInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '').substring(0, 4);
        if (value.length > 2) {
            value = value.substring(0, 2) + ' / ' + value.substring(2);
        }
        e.target.value = value;
    });

    document.getElementById('paymentForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach(group => group.classList.remove('error'));

        let isValid = true;
        const cardNumber = cardNumberInput.value.replace(/\s/g, '');
        const expiryDate = expiryDateInput.value.replace(/\s/g, '').replace('/', '');
        const cvv = document.getElementById('cvv').value;

        if (cardNumber.length !== 12) {
            isValid = false;
            document.getElementById('cardNumberGroup').classList.add('error');
        }

        if (expiryDate.length !== 4) {
            isValid = false;
            document.getElementById('expiryDateGroup').classList.add('error');
        }

        if (cvv.length !== 3) {
            isValid = false;
            document.getElementById('cvvGroup').classList.add('error');
        }

        if (isValid) {
            alert('Form submitted successfully!');
        }
    });
    
</script>
<script>
    
</script>

</body>

</html>
