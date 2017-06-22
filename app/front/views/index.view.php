<!DOCTYPE HTML>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <title>ESGI - Geographik</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'main.css' ?>" />
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'modal.css' ?>" />
    <noscript>
        <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'noscript.css' ?>" />
    </noscript>
    <script src="assets/js/libs.js"></script>
    <script src="assets/js/main.js"></script>
</head>
<body class="page-landing is-loading">
<div id="wrapper">
    <div id="header" class="alt ">
        <h1><a href="#">esgi</a></h1>
        <nav id="nav">
            <a href="#">Home</a>
            <a href="#">Actualités</a>
            <a href="#">Présentation</a>
            <a href="#">Articles</a>
            <a href="#">Galerie</a>
            <a href="<?=LINK_FRONT; ?>register">Inscription</a>
            <a href="<?=LINK_FRONT; ?>login">Connexion</a>
            <!--<a><button onclick="document.getElementById('id01').style.display='block'">Login</button></a>-->
        </nav>
    </div>
    <div id="banner">
        <div class="inner">
            <ul class="actions big">
                <li><a href="#" class="button big scrolly">Start</a></li>
            </ul>
        </div>
    </div>
    <section id="items">
        <article class="item">
            <header>
                <h2>Article 1</h2>
                <span class="category">CATEGORIE</span>
            </header>
            <a href="#" class="image lazy" style="background-color: #d1bcc0;">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'photo1.jpeg' ?>" />
            </a>
        </article>
        <article class="item">
            <header>
                <h2>Article 2</h2>
                <span class="category">CATEGORIE</span>
            </header>
            <a href="#" class="image lazy" style="background-color: #a3afb1;">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'photo2.jpg' ?>" />
            </a>
        </article>
        <article class="item">
            <header>
                <h2>Article 3</h2>
                <span class="category">CATEGORIE</span>
            </header>
            <a href="#" class="image lazy" style="background-color: #e6e1e0;">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'photo3.jpg' ?>" />
            </a>
        </article>


    </section>


    <!-- The Modal -->
    <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'avatar.png' ?>" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit">Login</button>
                <input type="checkbox" checked="checked"> Remember me
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>

    <div id="footer">
        <ul class="menu">
            <li><a href="#">Help</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">License</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="copyright">
            &copy; All rights reserved.
            <a class="offsite" href="#">ESGI - Geographik</a>
            .
        </div>
    </div>
</div>
</body>
</html>
