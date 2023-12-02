
//Calling login.php Using AJAX

$(document).ready(function () {
    $("#loginForm").submit(function (event) {
        event.preventDefault();

        // Get form data
        var formData = $(this).serialize();

        // Make Ajax request
        $.ajax({
            type: "POST",
            url: "../guvi/php/login.php",
            data: formData,
            success: function (response) {
                alert(response);

                if (response.trim() === "Login successful!") {
                    var userEmail = $("#email").val(); 
                    localStorage.setItem("email", userEmail);
                    localStorage.setItem("isLoggedIn", "true");

                    // Redirect to the profile section
                    window.location.href = "profile.html";
                }
            },
            error: function (error) {
                console.error("Ajax request failed:", error);
            }
        });
    });
});