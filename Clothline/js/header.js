document.addEventListener('DOMContentLoaded', function() {
    // Get the specific <li> element containing the "greeting" div
    const greetingLi = document.querySelector('.navbar li.greeting');
    
    // Check if the greetingLi element exists
    if (greetingLi) {
        // Create a new div element for the greeting message
        const greetingDiv = document.createElement('div');
        greetingDiv.id = 'greeting';

        // Get the current hour
        const currentHour = new Date().getHours();

        // Determine the appropriate greeting based on the time of day
        let greetingMessage = '';
        if (currentHour >= 5 && currentHour < 12) {
            greetingMessage = 'Good Morning!';
        } else if (currentHour >= 12 && currentHour < 17) {
            greetingMessage = 'Good Afternoon!';
        } else {
            greetingMessage = 'Good Evening!';
        }

        // Set the text content of the greeting div
        greetingDiv.textContent = greetingMessage;

        // Append the greeting div to the <li> element
        greetingLi.appendChild(greetingDiv);
    }
});
