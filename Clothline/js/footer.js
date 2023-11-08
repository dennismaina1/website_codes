document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const footer = document.getElementById('footer'); // Get the greeting element
  
    // Check if dark mode is enabled in localStorage
    const isDarkModeEnabled = localStorage.getItem('darkMode') === 'true';
  
    // Toggle dark mode when the button is clicked
    darkModeToggle.addEventListener('click', function() {
        if (body.classList.contains('dark-mode')) {
            footer.classList.remove('dark-mode'); // Remove dark mode class from greeting
        } else {        
            footer.classList.add('dark-mode'); // Add dark mode class to greeting
        }
    });
  });
  