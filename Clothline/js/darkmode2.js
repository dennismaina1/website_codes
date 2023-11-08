document.addEventListener('DOMContentLoaded', function() {
    const switchInput = document.querySelector('.switch input');
    const resetCard = document.querySelector('.reset-card');
    
    

    // Check if dark mode is enabled in localStorage
    const isDarkModeEnabled = localStorage.getItem('darkMode') === 'true';

    // Update the switch state and dark mode class based on localStorage
    switchInput.checked = isDarkModeEnabled;
    if (isDarkModeEnabled) {
        document.body.style.backgroundImage = "url('images/dark.jpeg')";
        resetCard.classList.add('dark-mode');
        
    }

    switchInput.addEventListener('change', function() {
        if (this.checked) {
            // Set the background image to dark.jpg
            document.body.style.backgroundImage = "url('images/dark.jpeg')";
            // Add the dark-mode class to login-card
            resetCard.classList.add('dark-mode');
           
            localStorage.setItem('darkMode', 'true');
        } else {
            // Set the background image to bright.jpg
            document.body.style.backgroundImage = "url('images/background.jpg')";
            // Remove the dark-mode class from login-card
            resetCard.classList.remove('dark-mode');
            
            // Store dark mode state in localStorage
            localStorage.setItem('darkMode', 'false');
        }
    });
});
