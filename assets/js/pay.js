function toggleDropdown(contentId, arrowId, textId, element) {
    const dropdownContents = document.querySelectorAll('.dropdown-content');
    const dropdownArrows = document.querySelectorAll('.right-section img');
    const payTexts = document.querySelectorAll('.p-subtext');
    const dropdownContainers = document.querySelectorAll('.dropdown-container');

    // Close all dropdowns
    dropdownContents.forEach(content => {
        if (content.id !== contentId) {
            content.classList.remove('show');
        }
    });
    dropdownArrows.forEach(arrow => {
        arrow.classList.remove('rotated');
    });
    payTexts.forEach(text => {
        text.classList.remove('subtext-hide'); // Remove hide class from all texts
    });
    dropdownContainers.forEach(container => {
        container.classList.remove('dropdown-transparent'); // Remove transparent class from all
    });

    // Toggle the clicked dropdown
    const dropdownContent = document.getElementById(contentId);
    const dropdownArrow = document.getElementById(arrowId);
    const payText = document.getElementById(textId);

    if (dropdownContent.classList.contains('show')) {
        dropdownContent.classList.remove('show');
        dropdownArrow.classList.remove('rotated');
        payText.classList.remove('subtext-hide'); // Remove the hide class when closing
    } else {
        dropdownContent.classList.add('show');
        dropdownArrow.classList.add('rotated');
        payText.classList.add('subtext-hide'); // Add this line to hide the subtext when opening
        element.parentElement.classList.add('dropdown-transparent'); // Add transparent class to the opened dropdown
    }
}

function togglePayButton(radio) {
    // Hide all right-side divs first
    const rightSides = document.querySelectorAll('.right-side');
    rightSides.forEach(side => side.classList.remove('active'));

    // Show the right-side div for the selected radio button
    let rightSideId = '';
    if (radio.id === 'hdfc') {
        rightSideId = 'rightSidehdfc';
    } else if (radio.id === 'icici') {
        rightSideId = 'rightSideicici';
    } else if (radio.id === 'sbi') {
        rightSideId = 'rightSidesbi';
    } else if (radio.id === 'googlePay') {
        rightSideId = 'rightSideGoogle';
    } else if (radio.id === 'phonePe') {
        rightSideId = 'rightSidePhonePe';
    } else if (radio.id === 'paytm') {
        rightSideId = 'rightSidePaytm';
    } else if (radio.id === 'g-pay') {
        rightSideId = 'rightSideg-pay';
    }
    

    const rightSide = document.getElementById(rightSideId);
    rightSide.classList.add('active');
}

function selectPaymentOption(paymentId) {
    const radio = document.getElementById(paymentId);
    radio.checked = true; // Check the radio button
    togglePayButton(radio); // Toggle the visibility of the button
}
window.onload = function () {
    const defaultRadioBank = document.getElementById('hdfc');
    const defaultRadioUPI = document.getElementById('phonePe');

    // Check the default radio buttons and show the corresponding buttons
    defaultRadioBank.checked = true; // Set HDFC as default
    togglePayButton(defaultRadioBank); // Show HDFC button

    defaultRadioUPI.checked = true; // Set Google Pay as default
    togglePayButton(defaultRadioUPI); // Show Google Pay button

    // Open UPI dropdown and add transparent background
    const dropdownContentUPI = document.getElementById('dropdownContentUPI');
    const dropdownArrowUPI = document.getElementById('dropdownArrowUPI');
    const payTextUPI = document.getElementById('payTextUPI');

    dropdownContentUPI.classList.add('show');
    dropdownArrowUPI.classList.add('rotated');
    payTextUPI.classList.add('subtext-hide');
    const upiDropdownContainer = dropdownContentUPI.closest('.dropdown-container');
    upiDropdownContainer.classList.add('dropdown-transparent'); // Add transparent class
};


