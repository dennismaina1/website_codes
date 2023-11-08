document.addEventListener('DOMContentLoaded', function() {
  const darkModeToggle = document.getElementById('darkModeToggle');
  const body = document.body;
 
  // Check if dark mode is enabled in localStorage
  const isDarkModeEnabled = localStorage.getItem('darkMode') === 'true';

  // Update the switch state and dark mode class based on localStorage
  darkModeToggle.innerHTML = isDarkModeEnabled ? '<i class="fa fa-moon" style="font-size:20px;color:red;"></i>' : '<i class="fa fa-sun" style="font-size:20px;color:white;"></i>';
  body.classList.toggle('dark-mode', isDarkModeEnabled);
  if (isDarkModeEnabled) {
      body.style.backgroundImage = "url('images/dark.jpeg')";
  }

  // Set the initial color of the greeting based on dark mode
  greeting.classList.add(isDarkModeEnabled ? 'dark-mode' : 'normal-mode');

  // Toggle dark mode when the button is clicked
  darkModeToggle.addEventListener('click', function() {
      if (body.classList.contains('dark-mode')) {
          body.classList.remove('dark-mode');
          darkModeToggle.innerHTML = '<i class="fa fa-sun" style="font-size:20px;color:white;"></i>';
          body.style.backgroundImage = "url('images/background.jpg')";
          
          localStorage.setItem('darkMode', 'false');
      } else {
          body.classList.add('dark-mode');
          darkModeToggle.innerHTML = '<i class="fa fa-moon" style="font-size:20px;color:red;"></i>';
          body.style.backgroundImage = "url('images/dark.jpeg')";
        
          localStorage.setItem('darkMode', 'true');
      }
  });
});
