<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['userId']) || $_SESSION['userRole'] !== 'Admin') {
  header("Location: login.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CareMeds</title>
    <link rel="stylesheet" href="admin-styles/admin-dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
  </head>
  <body>
    <?php
    require 'dbconnection.php';
           $sqlCategory = "SELECT c.categoryName, SUM(p.productQty) AS CategoryCount 
           FROM categories c 
           LEFT JOIN products p ON c.categoryId = p.categoryId 
           GROUP BY c.categoryName";
           
           $sqlBar = "SELECT p.productName, c.quantity AS ProductQty
           FROM products p
           INNER JOIN cart c ON p.productId = c.productId
           ORDER BY c.quantity DESC
           LIMIT 5";


    $sqlOrders= "SELECT COUNT(orderId) AS total_orders FROM orders";
    $sqlProducts="SELECT COUNT(ProductId) AS total_products FROM products";
    $sqlCustomers="SELECT COUNT(custId) AS total_customers FROM customer";
    $sqlTotalPrice="SELECT SUM(totalAmount) AS total_price FROM orders" ;

    $totalOrders = fetchCount($conn,$sqlOrders);
    $totalProducts = fetchCount($conn,$sqlProducts);
    $totalCategory = fetchCount($conn,$sqlCategory);
    $totalCustomers = fetchCount($conn,$sqlCustomers);
    $totalPrice = fetchTotalPrice($conn,$sqlTotalPrice);
    
    $resultPieChart = $conn ->query($sqlBar);
    $productNames = [];
    $productCounts = [];

    if($resultPieChart->num_rows > 0){
      while($row = $resultPieChart->fetch_assoc()){
          $productNames[] = $row['productName'];
          $productCounts[] = $row['ProductQty'];

      }
  }




    $resultBar = $conn->query($sqlCategory);
    $categories =[];
    $counts =[];

    if($resultBar->num_rows > 0){
      while($row = $resultBar->fetch_assoc()){
        $categories[] = $row['categoryName'];
        $counts[] = $row['CategoryCount'];
      }

    }

    function fetchCount ($conn,$sql){
      $result = $conn->query($sql);
      if($result && $result -> num_rows >0 ){
        $row =$result->fetch_assoc();
        return $row[array_keys($row)[0]];
      }
      return 0;
    }

    function fetchTotalPrice($conn,$sql){
      $result = $conn -> query($sql);
      if($result && $result -> num_rows >0){
        $row = $result->fetch_assoc();
        return $row['total_price']; // Return total price
    }
    return 0;

    }
    $conn->close();


    ?>
    <div class="admin-dashboard-container">
      <div class="side-navbar">
        <div class="div-logo">
        <img src="./admin-images/logo1.png" class="logo-img" alt="">
        </div>
        <div class="admin-user">
          <img src="./admin-images/driver.png" class="admin-user-img" alt="">
          <div class="admin-user-text" >
          <h2><?php echo $_SESSION['userName'] ;?></h2>
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
          <a href="admin-view-orders.php"> Manage Orders</a>
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
          <li><i class="fa-solid fa-users admin-icons"></i>
        
          <a href="admin-customer.php">View Customers</a>
        </li>
        </ul>
        <ul class="side-nav-ul">
          <li><img src="./admin-images/logout.png "width="30px" class="admin-logout" alt=""><a href="logout.php">Logout</a></li>
        </ul>
    
      </div>
      <div class="content-dashboard">
        <div class="grid-container">
        <div class="grid-item">
          <h2>No of Orders</h2>
          <p><?php echo $totalOrders; ?></p>
      </div>
        <div class="grid-item large-width">
          <h2>No of Products</h2>
           <p><canvas id="productChart" width="400" height="300"></canvas></p>
        </div>
        <div class="grid-item large-height">
          <h2>No of Categories</h2>
          <p><canvas id="categoryChart" width="400" height="200"></canvas></p>
        </div>
        <div class="grid-item grid-cus">
          <h2>No of Customers</h2>
          <p><?php echo $totalCustomers; ?></p>
        </div>
        <!-- <div class="grid-item">
          <h2>No of Manufactures</h2>
          <p></p>
        </div> -->
        <div class="grid-item grid-tot">
          <h2>Total net</h2>
          <p><?php echo $totalPrice; ?></p>
        </div>
        </div>
        
      </div>
    </div>
    <script>
    var categoryNames = <?php echo json_encode($categories); ?>;
    var categoryCounts = <?php echo json_encode($counts); ?>;
    var productNames = <?php echo json_encode($productNames); ?>;
    var productCounts = <?php echo json_encode($productCounts); ?>;
   </script>
    <script src="admin-dashboard.js"></script>
  </body>
</html>
