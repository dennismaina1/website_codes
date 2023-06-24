<?php

  
  $title = "Homepage";
  $currentPage = "home";
  include "header.php";
  include "connect.php";
  $idnumber = $_SESSION['id'];
  
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xAVf+t62Blwz7MKKkI8uV7OXZHUrmb+hCv6lFX+6T+dJ6U01n6UwvDfHjW8+9sYsEjnAS/LrCF0rW+M70ixPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   

  <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <style>
        body { background-image:url("images\\background.jpg")}
        

    </style>
</head>
<body >
  <div class="container">
        <div class ="head">  
            <h1>Welcome to our Website!</h1>
            <p>Thank you for visiting us. We have a lot to offer you.</p>
        </div>
        
        <div class="slider-wrapper">
            <div class="slider">
                <img src="images/pic1.jpg" alt="Slider Image 1">
                <img src="images/pic2.jpg" alt="Slider Image 2">
                <img src="images/pic3.jpg" alt="Slider Image 3">
                <img src="images/pic4.jpg" alt="Slider Image 4">
                <img src="images/pic5.jpg" alt="Slider Image 5">
                <img src="images/pic6.jpg" alt="Slider Image 6">
            </div>
        </div> 
        <div class="container2">
        <div class ="mid">  
            <h1>Check Out Our Brands!</h1>
        </div>
        <div class="slide-container swiper" id = swipper>
            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                <?php
                try {
                    // Prepare and execute the SQL statement
                    $stmt = $conn->prepare("SELECT * FROM brands");
                    $stmt->execute();
                
                    // Check if the login was successful
                    if ($stmt->rowCount() > 0) {
                        while($row = $stmt->fetch()) {
                            $card_title = $row['Brand'];
                            $card_description = $row['Description'];
                            $card_price = $row['Price'];
                             
                echo
                    "<div class='card swiper-slide'>
                        <div class='image-content'>
                            <span class='overlay'></span>
                            <div class='card-image'>
                                <img src='images/$card_description.jpg' alt='' class='card-img'>
                            </div>
                        </div>
                        <div class='card-content'>
                            <h2 class='name'>$card_title - KES$card_price</h2>
                            <p class='description'>Description - $card_description</p>
                            <button class='button add-to-cart-btn''>Add to cart</button>
                        </div>
                    </div>";
                } 
            } 
        } catch(PDOException $e) {
            // Handle any exceptions thrown by PDO
            echo "Error: " . $e->getMessage();
        }
                ?>
                </div>  
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
            <div class="swiper-pagination"></div>
        </div>

        
        <div class="shopping-cart">
          <a href="checkout.php">
             <i class="fa-shopping-cart"></i>
             <span class="badge">0</span>
          </a>
        </div>
        
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
  // Add event listener to the parent element of the Add to cart button
  document.addEventListener('click', function(event) {
    // Check if the clicked element is the Add to cart button
    if (event.target.classList.contains('add-to-cart-btn')) {
      // Get the card title, price, and quantity
      const cardTitle = event.target.closest('.card').querySelector('.name').textContent;
      const cardPrice = parseFloat(event.target.closest('.card').querySelector('.name').textContent.replace(/[^0-9.-]+/g,""));
      const quantity = 1;
      
      // Call the addToCart function with the card details
      addToCart(cardTitle, cardPrice, quantity);
    }
  });
  </script>
<script>
  var cartItems = [];

  function addToCart(title, price, quantity) {
    var userId = '<?php echo $_SESSION["id"]; ?>';
    var item = {
      title: title,
      price: price,
      quantity: quantity
    };
    cartItems.push(item);
    updateCartIcon(cartItems.length);
    
    $.ajax({
    url: 'add_to_cart.php',
    method: 'POST',
    data: {
      title: title,
      price: price,
      quantity: quantity,
      userId: userId
    },
    success: function(response) {
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
    
  }

  function updateCartIcon(cartItemCount) {
    var shoppingCartIcon = document.querySelector('.shopping-cart');
    var cartIcon = shoppingCartIcon.querySelector('i');
    var cartIconBadge = shoppingCartIcon.querySelector('.badge');
    cartIconBadge.textContent = cartItemCount;
    cartIcon.classList.add('fa-shopping-cart');
    cartIcon.classList.remove('fa-shopping-cart');
  }
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script >
    var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
  });
</script>
<script>


const currentLocation = location.href;
const navLinks = document.querySelectorAll("nav ul li a");
const navLength = navLinks.length;
for (let i = 0; i < navLength; i++) {
  if (navLinks[i].href === currentLocation) {
    navLinks[i].classList.add("active");
  }
}
    </script>
    <script>
 // select the slider and slides
const slider = document.querySelector('.slider');
const slides = slider.querySelectorAll('img');

// set the current slide index and direction
let currentSlide = 0;
let direction = 1; // 1 for forward, -1 for backward

// set the slide position and translate the slider
const slidePosition = () => {
  return currentSlide * -20;
};
slider.style.transform = `translateX(${slidePosition()}%)`;

// set the slide interval and update the slide position
const slideInterval = setInterval(() => {
  currentSlide += direction;
  if (currentSlide === slides.length - 3 || currentSlide < 0) {
    direction = -direction; // reverse the direction
    currentSlide += direction * 2; // go back two steps
  }
  slider.style.transform = `translateX(${slidePosition()}%)`;
},6000);


</script>


</html>
