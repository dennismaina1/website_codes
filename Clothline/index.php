<?php

  
  $title = "Homepage";
  $currentPage = "home";
  include "header.php";
  include "connect.php";
  $idnumber = $_SESSION['id'];
  
?>

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
    
        
        <div class="shopping-cart">
          <a href="checkout.php">
             <i class="fa-shopping-cart"></i>
             <span class="badge">0</span>
          </a>
        </div>
        
  </div>

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

<?php include 'footer.php'; ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

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
