//Calling profile.php Using AJAX

$(document).ready(function () {

    // If logged in, make an AJAX request to fetch user details
    var userEmail = localStorage.getItem("email");
    console.log(userEmail)

    $.ajax({
        type: "POST",
        url: "../guvi/php/profile.php",
        data: { email: userEmail },
        success: function (response) {
            var userData = JSON.parse(response);

            // Update the profile card with user information
            $(".1").text("Name: " + userData.name);
            $(".2").text("Mobile: " + userData.mobile);
            $(".3").text("Email: " + userData.email);
  
        },
        error: function (error) {
            console.error("Ajax request failed:", error);
        }
    });
});


$(document).ready(function () {
    // Logout button click event
    $("#logoutBtn").on("click", function () {
        // Clear local storage data
        localStorage.removeItem("login");
        localStorage.removeItem("email");

        // Redirect to the login page
        window.location.href = "login.html";
    });
});