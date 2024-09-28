

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home-page.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <title>Care Meds</title>
  </head>
  <body>
    <div class="full">
    <?php
include_once 'homepage-header.php';
?>
      <!-- <div class="container">
        <div class="logo">
          <img src="./assets/2-removebg-preview.png" alt="logo image" />
        </div>
        <nav class="nav-bar">
          <ul>
            <li>
              <a href="http://localhost/E-pharmacy/home-page.php" class="link">Home</a>
              <a href="#" class="link">About Us</a>
              <a href="#" class="link">Products</a>
              <a href="#" class="link">Contact Us</a>
            </li>
          </ul>
        </nav>
        <div class="login-button">
           <a href="http://localhost/E-pharmacy/login.php" class="a-lgn"> 
            <button class="btn-login">Login</button>
          </a>
          <button class="btn-login">Sign Up</button>
        </div> 
      </div>-->

      <div class="home-hero">
        <video
          autoplay
          loop
          muted
          class="back"
          src="./assets/istockphoto-1400100931-640_adpp_is.mp4"
        ></video>
      </div>

      <div class="middle-part">
        <h1>Welcome to <span>CareMeds</span>🩺</h1>
        <p class="hero-p">
          Your trusted online pharmacy, delivering medications and health
          products straight to your door. We prioritize your health with fast,
          secure, and convenient service.
        </p>
       <a href="http://localhost/E-pharmacy/prescription.php"> <button class="home-upload">Upload Prescription <i class="fa-solid fa-upload"></i></button></a>
      </div>
    </div>

    <!-- //////////////////////////////////// -->
    <div class="product-listt">
      <h1>PRODUCTS</h1>
      <p>
        Discover a wide range of quality medications and health products
        tailored to meet your needs. Fast, reliable, and delivered right to your
        doorstep.
      </p>
      <div class="home-products">
        <div class="slide">
          <div
            class="item"
            style="background-image: url(./assets/image\ copy\ 2.png)"
          >
            <div class="content">
              <div class="name">Skin Care</div>
              <div class="des">Best products</div>
              <button class="btn-see">See More</button>
            </div>
          </div>

          <div
            class="item"
            style="background-image: url(./assets/image\ copy.png)"
          >
            <div class="content">
              <div class="name">Hair Care</div>
              <div class="des">Best products</div>
              <button class="btn-see">See More</button>
            </div>
          </div>

          <div
            class="item"
            style="background-image: url(./assets/image\ copy\ 3.png)"
          >
            <div class="content">
              <div class="name">Vitamins</div>
              <div class="des">
                LORES IPSUM DOLOR SIT AMET CONSERTDE ADIPIYTIO DIDE AB DJ
              </div>
              <button class="btn-see">See More</button>
            </div>
          </div>

          <div
            class="item"
            style="background-image: url(./assets/image\ copy\ 11.png)"
          >
            <div class="content">
              <div class="name">Antibiotis</div>
              <div class="des">
                LORES IPSUM DOLOR SIT AMET CONSERTDE ADIPIYTIO DIDE AB DJ
              </div>
              <button class="btn-see">See More</button>
            </div>
          </div>

          <div
            class="item"
            style="background-image: url(./assets/image\ copy\ 6.png)"
          >
            <div class="content">
              <div class="name">First Aid</div>
              <div class="des">
                LORES IPSUM DOLOR SIT AMET CONSERTDE ADIPIYTIO DIDE AB DJ
              </div>
              <button class="btn-see">See More</button>
            </div>
          </div>
        </div>
        <div class="button-1">
          <button class="prev">←</button>
          <button class="next">→</button>
        </div>
      </div>
    </div>

    <!-- ////////////testamonials/////////////// -->
    <div class="testamonial">
      <div class="testmonials-con">
        <div class="test-header">
          <p>TESTIMONIALS</p>
          <h1>what our clients says about us.</h1>
        </div>
        <div class="testimonals-grid">
          <div class="testimonial-car">
            <span><i class="fa-solid fa-quote-left"></i></span>
            <p>
              i have been working with these guysfor a long time i can say that
              my house is in perfect hands
            </p>
            <hr />
            <img src="assets/image copy 7.png" alt="" />
            <p class="test-name">Allaya meegoda</p>
          </div>

          <div class="testimonial-car">
            <span><i class="fa-solid fa-quote-left"></i></span>
            <p>
              i have been working with these guysfor a long time i can say that
              my house is in perfect hands
            </p>
            <hr />
            <img src="assets/image copy 9.png" alt="" />
            <p class="test-name">Allaya meegoda</p>
          </div>
          <div class="testimonial-car">
            <span><i class="fa-solid fa-quote-left"></i></span>
            <p>
              i have been working with these guysfor a long time i can say that
              my house is in perfect hands
            </p>
            <hr />
            <img src="assets/image copy 8.png" alt="" />
            <p class="test-name">Allaya meegoda</p>
          </div>
        </div>
        <div class="test-footer">
          <h4>No two homes are alike!</h4>
          <p>LORES IPSUM DOLOR SIT AMET CONSERTDE ADIPIYTIO DIDE AB DJ</p>
          <button>GET A QUOTE</button>
          <!-- <div class="social-icons">
            <a href="https://www.facebook.com/"
              ><i class="fa-brands fa-facebook"></i
            ></a>
            <a href=""><i class="fa-brands fa-twitter-square"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-linkedin"></i></a>
          </div> -->
        </div>
      </div>
      <div class="social-icons">
        <a href="https://www.facebook.com/"
          ><i class="fa-brands fa-facebook"></i
        ></a>
        <a href=""><i class="fa-brands fa-twitter-square"></i></a>
        <a href=""><i class="fa-brands fa-instagram"></i></a>
        <a href=""><i class="fa-brands fa-linkedin"></i></a>
      </div>
    </div>

    <script src="./home-page.js"></script>
  </body>
</html>