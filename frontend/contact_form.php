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
            <option disabled="disabled" selected>Contact subject</option>
            <option value="Subject 1">Subject 1</option>
            <option value="Subject 2">Subject 2</option>
            <option value="Subject 3">Subject 3</option>
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