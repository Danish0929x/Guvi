//Calling register.php Using AJAX


$(document).ready(function () {
    $("#registrationForm").submit(function (event) {
        event.preventDefault();

        // Get form data
        var formData = $(this).serialize();
        console.log(formData);

        // Make Ajax request
        $.ajax({
            type: "POST",
            url: "../guvi/php/register.php",
            data: formData,
            success: function (response) {
                // Check if the registration was successful
                if (response === "Registration successful!") {
                    // Set email and login status in local storage
                    localStorage.setItem("email", $("#email").val());
                    localStorage.setItem("login", true);

                    // Redirect to the profile page
                    window.location.href = "profile.html";
                } else {
                    alert(response);
                }
            },
            error: function (error) {
                console.error("Ajax request failed:", error);
            }
        });
    });
});