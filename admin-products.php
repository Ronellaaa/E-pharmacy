
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CareMeds</title>
    <link rel="stylesheet" href="admin-styles/admin-products.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
   
    <div class="admin-dashboard-container">
      <div class="side-navbar">
        <div class="div-logo">
        <img src="./admin-images/logo1.png" class="logo-img" alt="">
        </div>
        <div class="admin-user">
          <img src="./admin-images/driver.png" class="admin-user-img" alt="">
          <div class="admin-user-text" >
          <h2>John Doe</h2>
          <p>Admin</p>
          </div>
        </div>

        <ul class="side-nav-ul">
          <li>
            <i class="fa-solid fa-gauge admin-icons"></i>
            <a href="admin-dashboard.php">Dashboard</a>
          </li>

          <li>
          <i class="fa-solid fa-file admin-icons"></i>
            <a href="admin-view-pres.php">Prescriptions</a>
        </li>


          <li><i class="fa-solid fa-clipboard-check admin-icons"></i>
           <a href="admin-view-orders.php">Manage Orders</a>
        </li>
          <li class="products-item">
            <i class="fa-solid fa-prescription-bottle-medical admin-icons"></i>
             <a href="#">Products</a>
            <i class="fa-solid fa-chevron-right side-arrow" ></i>
            <ul class="dropdown-ul">
              <li class="dropdown-ul-li-1"><a href="admin-products.php">Add Products</a></li>
              <li class="dropdown-ul-li-2"><a href="admin-view-products.php">Manage products</a></li>
            </ul>
          </li>
          <li><i class="fa-solid fa-users admin-icons">
          </i>
           <a href="admin-view-customers.php">View Customers</a>
        </li>
        </ul>
        <ul class="side-nav-ul">
          <li>
            <img src="./admin-images/logout.png "width="30px" class="admin-logout" alt="">
            <a href="#">Logout</a>
          </li>
        </ul>
       
      
    
      </div>
      <div class="admin-products-container">
    
             <div class="admin-products">
                <div class="admin-pick-category"><a href="admin-add-category.php">Add Category</a></div>
                <div class="admin-pick-products"><a href="admin-add-products.php">Add Products</a></div>
             </div>
       </div>
    </div>

    <script src="admin-dashboard.js"></script>
  </body>
</html>
