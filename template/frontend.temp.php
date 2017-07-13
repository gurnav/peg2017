<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo App::$title ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'style_front.css' ?>" media="screen">

    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'main.css' ?>" />
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'modal.css' ?>" />

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'font-awesome-4.7.0'.DS.'css'.DS.'font-awesome.min.css' ?>" media="screen">

    <!-- scripts -->
    <noscript>
        <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'noscript.css' ?>" />
    </noscript>
    <script src="assets/js/libs.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- viewport for better responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<noscript>JavaScript is Disabled. Please put it on.</noscript>

<header>
    <div id="burger_menu">≡</div>
    <div class="menu">
        <nav id="nav_bar" class="nav_bar">
            <li><a href="<?php echo BASE_URL ?>">Home</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_articles' ?>">Articles</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_news' ?>">News</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_pages' ?>">Pages</a></li>
			<li><a href="<?php echo BASE_URL.'contents/gallery' ?>">Gallery</a></a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="<?php echo BASE_URL.'profile'; ?>">Profile</a></li>
                <li><a href="<?php echo BASE_URL.'login/logout'; ?>"><button>log<i class="fa fa-power-off" aria-hidden="true"></i>ut</button></a></li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['user'])): ?>
                <li><a href="<?php echo BASE_URL.'register' ?>">Register</a></li>
                <li><a href="<?php echo BASE_URL.'login' ?>">Login</a></li>
            <?php endif; ?>
        </nav>
    </div>
</header>

<body>

<?php include 'app'.DS.App::$prefix.DS.'views'.DS.$this->view.'.view.php'; ?>


<footer>
    <div id="footer">
        <ul class="menu">
            <li><a href="#">Help</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="<?php echo PATH_RELATIVE.'cgu' ?>">CGU</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <ul class="menu">
            <li><a href="<?php echo PATH_RELATIVE.'rss' ?>"><img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'rss.png' ?>"></a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100019455224304"><img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'fb.png' ?>"></a></li>
            <li><a href="#"><img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'insta.png' ?>"></a></li>
        </ul>

        <div class="copyright">
            &copy; All rights reserved.
            <a class="offsite" href="#">ESGI - Geographik</a>
            .
        </div>
    </div>
</footer>

<!-- JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'js'.DS.'scripts_front.js' ?>"></script>
<script src="https://cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
</body>
</html>