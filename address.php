<!DOCTYPE html>
<html lang="en-IN">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Address</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/add.css">

</head>
<style>
    svg {
        margin-top: -1px;
        display: inline-block;
        vertical-align: middle;
        width: 16px;
        height: 16px
    }

    header nav {
        display: flex;
        gap: 30px;
        align-items: center;
        background-color: #fff;
        height: 50px;
        padding: 1px 15px;
        font-weight: 500;
        font-size: 16px
    }

    .process-bar {
        display: flex;
        justify-content: center;
        background-color: #ffffff;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        box-shadow: 0 4px 8px -8px;
    }
</style>
<header>
    <nav>
        <div class="back-arrow" onclick="goBack()">
            <svg width="19" height="16" viewBox="0 0 19 16" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.556 7.847H1M7.45 1L1 7.877l6.45 6.817" stroke="black" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
            </svg>
        </div>

        <script>
            function goBack() {
                window.history.back();  // This will go to the previous page in the browser history
            }
        </script>

        <div class="pagename">Add delivery address</div>
    </nav>
    <div class="process-bar">
        <img src="assets/images/svg/p1.svg" alt="">
    </div>
</header>

<body>

    <div class="container">
        <form method="POST" id="addressForm">
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="name" name="name" placeholder="Full name"
                        oninput="autoCapitalize(this)" required>
                    <label for="floatingInput">Full Name (Required)*</label>
                    <small class="error-message" style="color: red; display: none;">Please fill out this field.</small>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="number" name="number" placeholder="Mobile number"
                        required maxlength="10" oninput="validatePhoneNumber(this)">
                    <label for="floatingInput">Mobile number (Required)*</label>
                </div>

                <p id="addAlternateText" style="color: #007bff; cursor: pointer; margin-bottom: 20px;">+ Add Alternate
                    Phone Number</p>

                <div id="alternateNumberContainer" style="display: none;" class="form-floating mb-3">
                    <input class="form-control" type="text" id="alternateNumber" name="alternateNumber"
                        placeholder="Alternate mobile number" maxlength="10" oninput="validatePhoneNumber(this)">
                    <label for="alternateNumber">+ Add Alternate Phone Number</label>
                </div>

                <div class="row">
                    <div class="col-6 form-floating">
                        <input class="form-control" type="text" id="pin" name="pin" placeholder="PIN code" required
                            maxlength="6" oninput="validatePinCode(this)">
                        <label for="pin">PIN Code (Required)*</label>
                    </div>


                    <div class="col-6 form-floating">
                        <div class="location" id="locationButton">
                            <div class="location-img">
                                <div class="spinner" id="spinner" style="display: none;"></div>
                                <img class="_3Syggg" src="assets/images/svg/location.svg" width="18" height="18" id="locationIcon">
                                <div class="W-TPaR _279B1i" id="buttonText">Use my location</div>
                            </div>
                        </div>
                        <p class="error-message" id="errorMessage" style="display: none;">Unable to Fetch Your Location
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 form-floating">
                        <select class="form-select" id="state" name="state" required>
                            <option value="">Select State</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu & Kashmir">Jammu & Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                            <option value="Andaman & Nicobar">Andaman & Nicobar</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                            <option value="Daman & Diu">Daman & Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadweep">Lakshadweep</option>
                            <option value="Pondicherry">Pondicherry</option>
                        </select>
                        <label for="floatingInput">State</label>
                    </div>

                    <div class="col-6 form-floating">
                        <input class="form-control" type="text" id="city" name="city" placeholder="Town/City"
                            oninput="autoCapitalize(this)" required>
                        <label for="floatingInput">City (Required)*</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="flat" name="flat"
                        placeholder="Flat, House.no, Building, Company" required>
                    <label for="floatingInput">House No., Building Name (Required)*</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" id="area" name="area"
                        placeholder="Area, Colony, Street, Sector, Village" required>
                    <label for="floatingInput">Road name, Area, Colony (Required)*</label>
                </div>

                <div>
                    <p class="gray">Type of address</p>
                    <input type="hidden" id="addressType" name="addressType" value="home">

                    <div class="button-container1">
                        <div class="btn active" id="homeBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path fill="currentColor"
                                    d="M15.746 7.232L8.346.14c-.193-.185-.499-.185-.692 0l-7.407 7.1C.09 7.397 0 7.613 0 7.834c0 .46.374.833.833.833H2V15c0 .552.448 1 1 1h2.833c.276 0 .5-.224.5-.5v-4.334c0-.091.075-.166.167-.166h3c.091 0 .167.075.167.166V15.5c0 .276.224.5.5.5H13c.552 0 1-.448 1-1V8.666h1.167c.459 0 .833-.374.833-.833 0-.22-.09-.437-.254-.6z" />
                            </svg>
                            <span>Home</span>
                        </div>
                        <div class="btn" id="workBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18">
                                <path fill="currentColor"
                                    d="M14.651 16.875V2.25c0-1.24-1.009-2.25-2.25-2.25h-9c-1.24 0-2.25 1.01-2.25 2.25v14.625H.026V18h15.75v-1.125h-1.125zm-5.625-13.5h2.25v2.25h-2.25v-2.25zm0 3.375h2.25V9h-2.25V6.75zm0 3.375h2.25v2.25h-2.25v-2.25zm-4.5-6.75h2.25v2.25h-2.25v-2.25zm0 3.375h2.25V9h-2.25V6.75zm0 3.375h2.25v2.25h-2.25v-2.25zm1.125 6.75V13.5h4.5v3.375h-4.5z" />
                            </svg>
                            <span>Work</span>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="common-button" type="submit">Save Address</button>
                </div>
            </div>
        </form>
    </div>
    <br><br>
    <script>
    document.getElementById("addressForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting

        // Get values from the form
        const name = document.getElementById("name").value;
        const number = document.getElementById("number").value;
        const alternateNumber = document.getElementById("alternateNumber") ? document.getElementById("alternateNumber").value : "";
        const pin = document.getElementById("pin").value;
        const state = document.getElementById("state").value;
        const city = document.getElementById("city").value;
        const flat = document.getElementById("flat").value;
        const area = document.getElementById("area").value;
        const addressType = document.getElementById("addressType").value;

        // Create an address object to store
        const address = {
            name,
            number,
            alternateNumber,
            pin,
            state,
            city,
            flat,
            area,
            addressType
        };

        // Retrieve existing addresses from localStorage, or create an empty array if none exist
        let addresses = JSON.parse(localStorage.getItem('addresses')) || [];

        // Check if the address already exists
        const isDuplicate = addresses.some(existingAddress => {
            return existingAddress.name === address.name &&
                existingAddress.number === address.number &&
                existingAddress.alternateNumber === address.alternateNumber &&
                existingAddress.pin === address.pin &&
                existingAddress.state === address.state &&
                existingAddress.city === address.city &&
                existingAddress.flat === address.flat &&
                existingAddress.area === address.area &&
                existingAddress.addressType === address.addressType;
        });

        // If it's not a duplicate, add the new address to the array
        if (!isDuplicate) {
            addresses.push(address);
            localStorage.setItem('addresses', JSON.stringify(addresses));

            // Redirect based on the URL parameter
            const params = new URLSearchParams(window.location.search);
            const redirect = params.get('redirect');
            if (redirect === 'next') {
                window.location.href = 'summary.php';
            } else if (redirect === 'cart') {
                window.location.href = 'cart.php';
            }
        } else {
            // Optionally, you can handle the duplicate case without an alert
            console.log("This address is already saved."); // Log to console instead
        }
    });

    function autoCapitalize(input) {
        // Transform the text so each word starts with a capital letter
        input.value = input.value
            .toLowerCase()
            .replace(/\b\w/g, char => char.toUpperCase());
    }
</script>
    <script src="assets/js/add.js"></script>
</body>

</html>