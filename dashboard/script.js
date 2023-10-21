document.querySelectorAll('.complaint-card').forEach(complaintCard => {
    complaintCard.addEventListener('click', () => {
        complaintCard.classList.toggle('expanded');
    });
});

const navbar = document.getElementById('navbar');

// Function to change the navbar color when scrolling
function handleScroll() {
    if (window.scrollY > 100) {
        // Add a CSS class to change the background color
        navbar.classList.add('navbar-scrolled');
    } else {
        // Remove the CSS class when scrolling back to the top
        navbar.classList.remove('navbar-scrolled');
    }
}

// Add a scroll event listener to the window
window.addEventListener('scroll', handleScroll);

document.getElementById('logoutButton').addEventListener('click', function() {
            // Redirect to the logout script when the button is clicked
            window.location.href = '../login-register/logout.php';
        });





// Get elements
var policeButton = document.getElementById("policeButton");
var hospitalButton = document.getElementById("hospitalButton");
var shelterButton = document.getElementById("shelterButton");
var safetyTipsButton = document.getElementById("safetyTipsButton");
var exitButton = document.getElementById("exitButton");
var mainContent = document.getElementById("locate");

// Event listeners for buttons
policeButton.addEventListener("click", function () {
    // Replace this with logic to display police station search form
    mainContent.innerHTML = '<h2 class="text-center">Search Police Station</h2><form action="../complaint_caller/2.php" method="POST" class="wrapper"><div class="form-group"><label for="stationName">Enter Station Name:</label><input type="text" class="form-control" id="stationName" name="stationName" required></div><button type="submit" class="btn btn-primary">Find Phone Number</button></form><div class="result"></div>';

});

hospitalButton.addEventListener("click", function () {
    // Replace this with logic to display hospital search form
    mainContent.innerHTML = '<h2 class="text-center">Search Hospitals</h2><form action="../complaint_caller/3.php" method="POST" class="wrapper"><div class="form-group"><label for="location">Enter Location:</label> <input type="text" class="form-control" id="hospitalName" name="location" required></div><button type="submit" class="btn btn-primary">Search Hospitals</button></form><div class="result"></div>';
});

shelterButton.addEventListener("click", function () {
    // Replace this with logic to display shelter search form
    mainContent.innerHTML = '<h2 class="text-center">Search Shelters</h2><form action="../complaint_caller/4.php" method="POST" class="wrapper"><div class="form-group"><label for="area">Enter Area:</label><input type="text" class="form-control" id="area" name="area" required></div><button type="submit" class="btn btn-primary">Search Shelters</button></form><div class="result"></div>';
});

exitButton.addEventListener("click", function () {
    // Redirect to a random website (example)
    var randomWebsites = ["https://www.nykaa.com", "https://www.myntra.com","https://www.amazon.com","https://www.flipkart.com","https://www.zomato.com","https://www.flipkart.com"];
    var randomIndex = Math.floor(Math.random() * randomWebsites.length);
    window.location.href = randomWebsites[randomIndex];
});
