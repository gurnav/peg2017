<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo SITE_NAME; ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'css'.DS.'style_front.css' ?>" media="screen">

    <link rel="stylesheet" href="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'css'.DS.'main.css' ?>" />

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'css'.DS.'font-awesome'.DS.'css'.DS.'font-awesome.min.css' ?>" media="screen">

    <!-- viewport for better responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<noscript>JavaScript is Disabled. Please put it on.</noscript>

<header class="main">
    <div class="menu">
        <div id="burger_menu">≡</div>
        <nav id="nav_bar" class="nav_bar"  <?php  ?> >
            <li><a href="<?php echo BASE_URL ?>">Home</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_articles' ?>">Articles</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_news' ?>">News</a></li>
            <li><a href="<?php echo BASE_URL.'contents/all_pages' ?>">Pages</a></li>
            <li><a href="<?php echo BASE_URL.'forum' ?>">Forum</a></a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['type'] === 'admin'): ?>
                    <li><a href="<?php echo BASE_URL.'admin';?>">Admin</a></li>
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL.'profile/show/'.$_SESSION['user']['username']; ?>">Profile</a></li>
                <li><a href="<?php echo BASE_URL.'login/logout'; ?>">Log<i class="fa fa-power-off" aria-hidden="true"></i>ut</></a></li>
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
            <li><a href="<?php echo BASE_URL.'help' ?>">Help</a></li>
            <li><a href="<?php echo BASE_URL.'cgu' ?>">CGU</a></li>
            <li><a href="<?php echo BASE_URL.'contact' ?>">Contact</a></li>
        </ul>
        <ul class="menu">
            <li><a href="<?php echo BASE_URL.'rss' ?>"><img src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'images'.DS.'rss.png' ?>"></a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100019455224304"><img src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'images'.DS.'fb.png' ?>"></a></li>
            <li><a href="#"><img src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'images'.DS.'insta.png' ?>"></a></li>
        </ul>

        <div class="copyright">
            &copy; All rights reserved.
            <a class="offsite" href="<?php echo BASE_URL ?>">ESGI - Geographik</a>
        </div>
    </div>
</footer>

<!-- JS -->
<noscript>
    <noscript>JavaScript is Disabled. Please put it on.</noscript>
</noscript>
<script src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'js'.DS.'libs.js' ?>"></script>
<script src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'js'.DS.'main.js' ?>"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'js'.DS.'scripts_front.js' ?>"></script>
<script src="https://cdn.ckeditor.com/4.7.1/basic/ckeditor.js"></script>
</body>
</html>
