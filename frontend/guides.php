<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Park Guides - Sarawak Park Guide System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section id="hero-section">
            <div class="hero-content">
                <h1>Meet Our Certified Park Guides</h1>
                <p>Discover the expertise and passion of our certified guides who are dedicated to enhancing your park
                    experience.</p>
            </div>
        </div>
    </section>

    <section class="guides-list">
        <div class="container">
            <h2 class="section-title">Our Experienced Guides</h2>
            <div class="guides-grid" id="guides-container">
                <p>Loading guides...</p>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>

    <script src="js/script.js"></script>
    <script src="js/guides.js"></script>
</body>

</html>
