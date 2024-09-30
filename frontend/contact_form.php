<!-- Updated form with action pointing to contact.php -->
<link href="../backend/includes/assets/css/themify-icons.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/flaticon.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/animate.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.theme.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/slick.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/slick-theme.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/swiper.min.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/odometer-theme-default.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/style.css" rel="stylesheet">

<form method="post" action="process_contact.php" id="contact-form-main" class="contact-validation-active">
    <div>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name*" required>
    </div><br>
    <div>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required>
    </div><br>
    <div>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone*" required>
    </div><br>
    <div>
        <select name="subject" class="form-control" id="subject" required>
        <option disabled="disabled" selected>Subject of Query</option>
            <option value="General Inquiry">General Inquiry</option>
            <option value="Coke Supply and Pricing">Coke Supply and Pricing</option>
            <option value="Energy Solutions">Energy Solutions</option>
            <option value="Shipping and Logistics">Shipping and Logistics</option>
            <option value="Partnership Opportunities">Partnership Opportunities</option>
            <option value="Technical Support">Technical Support</option>
            <option value="Other">Other</option>
        </select>
    </div><br>
    <div class="fullwidth">
        <textarea class="form-control" name="note" id="note" placeholder="Case Description..." required></textarea>
    </div><br>
    <div class="submit-area">
        <button type="submit" class="theme-btn">Submit Now</button>
        <div id="loader">
            <i class="ti-reload"></i>
        </div>
    </div>
</form>

<script>
    function thankYouMessage(event) {
        event.preventDefault(); // Prevent default form submission for demo
        // Display alert message after form submission
        alert("Thank you for contacting Aqua Terra Coke & Energy Limited! We will get back to you shortly.");
        
        // You can also redirect to a thank you page if needed
        // window.location.href = 'thank_you.html';

        // Simulate form submission after alert (for real submission, comment the line below)
        document.getElementById('contact-form-main').submit();
    }
</script>