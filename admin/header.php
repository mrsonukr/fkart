<?php
// This is header.php. It contains the common sidebar and header for all pages.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
  <nav>
    <div class="logo">
      <i class="bx bx-menu menu-icon"></i>
      <span class="logo-name">Dashboard</span>
      <div class="user-settings">
        <img src="img/user.png" alt="User Avatar" class="avatar">
      </div>
    </div>
    <div class="sidebar">
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">Dashboard</span>
      </div>
      <div class="sidebar-content">
        <ul class="lists">
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-home-alt icon"></i>
              <span class="link">Dashboard</span>
            </a>
          </li>
          <li class="list">
            <a href="view.php" class="nav-link">
              <i class="bx bx-bar-chart-alt-2 icon"></i>
              <span class="link">Edit Products</span>
            </a>
          </li>
          <li class="list">
            <a href="add_product.php" class="nav-link">
              <i class="bx bx-bell icon"></i>
              <span class="link">Add Product</span>
            </a>
          </li>
          <li class="list">
            <a href="slider.php" class="nav-link">
              <i class="bx bx-message-rounded icon"></i>
              <span class="link">Slider</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-pie-chart-alt-2 icon"></i>
              <span class="link">Analytics</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-heart icon"></i>
              <span class="link">Likes</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-folder-open icon"></i>
              <span class="link">Files</span>
            </a>
          </li>
        </ul>

        <div class="bottom-content">
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-cog icon"></i>
              <span class="link">Settings</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </div>
  </nav>

  <section class="overlay"></section>

  <script src="script.js"></script>
</body>
</html>
<script>const navBar = document.querySelector("nav"),
      menuBtns = document.querySelectorAll(".menu-icon"),
      overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });

    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });</script>