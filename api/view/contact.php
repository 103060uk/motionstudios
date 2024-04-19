<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us | Motion Studios</title>
    <link rel="stylesheet" href="../view/style/motion-studios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo&display=swap"
      rel="stylesheet"
    />
  </head>
  <?php include "../view/partials/navbar.php" ?>
  <body class="contact-us-page">
    <div class="cu-page-heading">
      <h2>Contact Us</h2>
    </div>
    <div class="cu-hero-banner">
      <div class="cu-hero-content">
        <h6>What Are You Waiting For?</h6>
        <a href="../controller/contact.php"
          ><button class="book-now-button-alt">BOOK NOW</button></a
        >
      </div>
    </div>
    <div class="cu-page-break">
      <h2>Got a question?</h2>
    </div>
    <div class="contact-form">
      <div class="contact-form-left">
        <div class="cf-left cf-left1">
          <h6>02347 982730</h6>
          <img src="../public/telephone-icon.svg" alt="Telephone Icon" />
        </div>
        <div class="cf-left cf-left2">
          <h6>07249 109384</h6>
          <img src="../public/whatsapp-icon.svg" alt="Whatsapp Icon" />
        </div>
        <div class="cf-left cf-left3">
          <h6>@motionstudios</h6>
          <img src="../public/instagram-icon.svg" alt="Instagram Icon" />
        </div>
      </div>
      <div class="contact-form-right">
        <h6>Drop us a message.</h6>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <section>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required />
          </section>
          <section>
            <label for="email">Email address:</label>
            <input type="email" id="email" name="email" required />
          </section>
          <section>
            <label for="tnumber">Telephone number (optional):</label>
            <input type="tel" id="tnumber" name="tnumber" />
          </section>
          <section>
            <label for="message">Your message:</label>
            <textarea name="message" id="message" rows="3" required></textarea>
          </section>
          <section id="inline-checkbox">
            <input type="checkbox" id="checkbox" name="checkbox" required />
            <label for="checkbox"
              >I AGREE TO MOTION STUDIOS PRIVACY POLICY</label
            >
          </section>
          <section>
            <input type="submit" id="submit" name="submit" value="SUBMIT" />
          </section>
        </form>
      </div>
    </div>
    <?php include "../view/partials/footer.php" ?>
    <script>
      // JS Form Validation
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submit").addEventListener("click", function(event) {
                var errors = [];

                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var telephone = document.getElementById("tnumber").value;
                var message = document.getElementById("message").value;
                var checkbox = document.getElementById("checkbox").checked;

                if (name.trim() === "") {
                    errors.push("Please enter your name.");
                }

                if (email.trim() === "") {
                    errors.push("Please enter your email address.");
                }

                if (message.trim() === "") {
                    errors.push("Please enter your message.");
                }

                if (!checkbox) {
                    errors.push("Please agree to Motion Studios privacy policy.");
                }

                // Display any errors relating to empty fields in an alert
                if (errors.length > 0) {
                    var errorMessage = "Please correct the following errors:\n\n";
                    errorMessage += errors.join("\n");

                    alert(errorMessage);

                    // Stop the form from submitting
                    event.preventDefault();
                }
            });
        });
    </script>
  </body>
</html>
