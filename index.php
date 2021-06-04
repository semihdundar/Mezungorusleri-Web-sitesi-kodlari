<?php
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","admin/class/");
include_once(DATA."baglanti.php");
define("SITE",$siteurl);
include_once(SAYFA."seo.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$sitebaslik?></title>
    <meta name="description" content="<?=$sitedescription?>">
     <meta name="keywords" content="<?=$siteanahtar?>">
    <!-- Main Page Title -->
    <!--Fevicon-->
    <link rel="icon" href="<?=SITE?>assets/images/favicon.png" type="image/x-icon" />
	<!--font-Google-->
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,600,700,800" rel="stylesheet">
	<!-- Font-awesome css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/font-awesome.min.css">
	<!-- Animate css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/animate.css">
	<!-- Main Slider css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/camera.css">
	<!-- Magnific css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/magnific-popup.css">
	<!-- Owl carousel css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/owl.carousel.min.css">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/bootstrap.min.css">
	<!-- Main style css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/style.css">
	<!-- responsive css -->
	<link rel="stylesheet" href="<?=SITE?>assets/css/responsive.css">
</head>
<body data-spy="scroll" data-target=".header-area" data-offset="50" id="home">
	<!--<div class="preloader">
	    <div class="preloader-inner-area">
	        <div class="loader-overlay">
	            <div class="l-preloader">
	                <div class="c-preloader"></div>
	            </div>
	        </div>
	    </div>
	</div> -->

	<?php include_once(DATA."ust.php"); ?>
	
	<?php

        if($_GET && !empty($_GET["sayfa"]))
        {
            $sayfa=$_GET["sayfa"].".php";
            if(file_exists(SAYFA.$sayfa))
            {
                include_once(SAYFA.$sayfa);
            }
            else
            {
                include_once(SAYFA."home.php");
            }
            
        }
        else
        {
            include_once(SAYFA."home.php");
        }

    ?>
  

	
	<?php
        include_once(DATA."footer.php");
    ?>
	<!--====================================================================
							Include All Js File 
	 ====================================================================-->
     <!-- All Plugin -->
	<script src="<?=SITE?>assets/js/jquery-1.12.4.min.js"></script>
	<script src="<?=SITE?>assets/js/isotope.pkgd.min.js"></script>
	<script src="<?=SITE?>assets/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?=SITE?>assets/js/owl.carousel.min.js"></script>
	<script src="<?=SITE?>assets/js/magnific-popup.min.js"></script>
	<script src="<?=SITE?>assets/js/jquery.counterup.min.js"></script>
	<script src="<?=SITE?>assets/js/waypoint.js"></script>
	<script src="<?=SITE?>assets/js/camera.min.js"></script>
	<script src="<?=SITE?>assets/js/jquery.easing.1.3.min.js"></script>
	<script src="<?=SITE?>assets/js/contact-form.js"></script>
    <script src="<?=SITE?>assets/js/parallax.min.js"></script>

    <script src="<?=SITE?>js/sistem.js"></script>
    <!-- Custom JS -->
	<script src="<?=SITE?>assets/js/scripts.js"></script>

    <script type="text/javascript" src="<?=SITE?>highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="<?=SITE?>highslide/highslide.css" />


<script type="text/javascript">
	hs.graphicsDir = '<?=SITE?>highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	hs.dimmingOpacity = .75;


	if (hs.addSlideshow) hs.addSlideshow({
		
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>
</body>
</html>