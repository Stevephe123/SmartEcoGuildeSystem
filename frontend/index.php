<?php include 'header.php'; ?>
<?php
//This is a session expired code
//	session_start();
//	
//	// prevent multiple logins
//	if (!isset($_SESSION['session_id'])){
//		
//        header("Location:login.php");
//	}
//	
//	// Auto logout user after 5 minutes (300 seconds) of inactivity
//	$_SESSION['timesup'] = false;
//	if (isset($_SESSION['time']) && ((time()-$_SESSION['time'])>300)){
//		$_SESSION['timesup'] = true;
//		header("Location: login.php");
//	} else { // Update time if still active
//		$time = time();
//		if (isset($_SESSION['email'])){
//			$email = $_SESSION['email'];
//		//}
//		
//            $conn = @mysqli_connect("localhost","phpadmin","Norman1095") or die("Unable to connect to database.");
//            @mysqli_select_db($conn,"dbino") or die ("Unable to select database");
//            
//            $update_session = "UPDATE userlist SET time='$time' WHERE email='$email'";
//            
//            // Execute query
//            @mysqli_query($conn, $update_session);
//            
//            @mysqli_close($conn);
//            $_SESSION['time'] = $time;
//        }
//	}
//	
//	
?>
<!-- Hero Section -->
    <section id="hero-section">
        <div class="hero-overlay">
            <h1>Explore Sarawak's Natural Wonders Hi</h1>
            <p>Discover the rich biodiversity and natural heritage of Sarawak’s National Parks and Nature Reserves with our certified park guides.</p>
            <div class="hero-buttons">
                <a href="#" class="btn">Explore Parks</a>
                <a href="#" class="btn outline">Become a Guide</a>
            </div>
        </div>
    </section>

<section class="features">
    <div class="container">
        <h2 class="section-title">Our Digital Park Guide System</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Interactive Maps</h3>
                <p>Explore park routes, attractions, and wildlife habitats with our detailed interactive maps.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3>Certified Guides</h3>
                <p>All our park guides undergo comprehensive training and certification to provide the best experience.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <h3>Digital Learning</h3>
                <p>Access comprehensive digital learning resources about Sarawak's unique biodiversity.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Ready</h3>
                <p>Take the park guide system with you on the go with our mobile-friendly platform.</p>
            </div>
        </div>
    </div>
</section>

<section class="featured-parks">
    <div class="container">
        <h2 class="section-title">Featured National Parks</h2>
        <div class="parks-grid" id="featured-parks-container">
            <p>Loading featured parks...</p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
