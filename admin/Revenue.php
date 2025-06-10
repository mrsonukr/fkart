<?php include('header.php'); ?>

<main class="main-content">
  <div class="revenue-header">
    <h1>Revenue Overview</h1>
    <p class="date-range">October 2024</p>
  </div>

  <!-- Account Balance Section -->
  <div class="account-balance">
    <div class="stat-card">
      <h3>Account Balance</h3>
      <p class="amount">$12,500</p>
    </div>
  </div>

  <!-- Buttons to toggle between Income and Withdrawal -->
  <div class="transaction-tabs">
    <button class="tab-button active" id="incomeTab">Hitesh</button>
    <button class="tab-button" id="withdrawalTab">Withdrawal</button>
  </div>

 <!-- Income Transaction Section -->
<div class="transactions" id="incomeTransactions">


  <!-- Individual Transaction Container -->
  <div class="transaction-container">
    <div class="transaction-details">
      <span class="transaction-date">10 JAN</span>
      <span class="transaction-source">Freelance Job</span>
      <span class="transaction-amount">$500</span>
      <span class="transaction-status status-completed">
        <!-- Success SVG Image -->
        <img src="img/success.svg" alt="Success" class="status-icon">
        Success
      </span>
    </div>
  </div>

  <div class="transaction-container">
    <div class="transaction-details">
      <span class="transaction-date">11 JAN</span>
      <span class="transaction-source">Client Payment</span>
      <span class="transaction-amount">$1,000</span>
      <span class="transaction-status status-completed">
        <!-- Success SVG Image -->
        <img src="img/success.svg" alt="Success" class="status-icon">
        Success
      </span>
    </div>
  </div>
</div>

<!-- Withdrawal Transaction Section -->
<div class="transactions" id="withdrawalTransactions" style="display: none;">
  

  <!-- Individual Transaction Container -->
  <div class="transaction-container">
    <div class="transaction-details">
      <span class="transaction-date">05 JAN</span>
      <span class="transaction-method">Bank Transfer</span>
      <span class="transaction-amount">$200</span>
      <span class="transaction-status status-completed">
        <!-- Success SVG Image -->
        <img src="img/success.svg" alt="Success" class="status-icon">
        Success
      </span>
    </div>
  </div>

  <div class="transaction-container">
    <div class="transaction-details">
      <span class="transaction-date">08 JAN</span>
      <span class="transaction-method">PayPal</span>
      <span class="transaction-amount">$150</span>
      <span class="transaction-status status-pending">
        <!-- Pending SVG Image -->
        <img src="img/pending.svg" alt="Pending" class="status-icon">
        Pending
      </span>
    </div>
  </div>
</div>



</main>

<?php include('footer.php'); ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Get the buttons for Income and Withdrawal
  const incomeButton = document.getElementById("incomeTab");
  const withdrawalButton = document.getElementById("withdrawalTab");
  
  // Get the transaction containers
  const incomeTransactions = document.getElementById("incomeTransactions");
  const withdrawalTransactions = document.getElementById("withdrawalTransactions");

  // Add event listeners to toggle between Income and Withdrawal
  incomeButton.addEventListener("click", function() {
    // Show Income Transactions and hide Withdrawal Transactions
    incomeTransactions.style.display = "block";
    withdrawalTransactions.style.display = "none";

    // Set the active class for the Income button
    incomeButton.classList.add("active");
    withdrawalButton.classList.remove("active");
  });

  withdrawalButton.addEventListener("click", function() {
    // Show Withdrawal Transactions and hide Income Transactions
    incomeTransactions.style.display = "none";
    withdrawalTransactions.style.display = "block";

    // Set the active class for the Withdrawal button
    withdrawalButton.classList.add("active");
    incomeButton.classList.remove("active");
  });

  // Default view is Income Transactions
  incomeTransactions.style.display = "block";
  withdrawalTransactions.style.display = "none";
});



</script>