<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo App::$title ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'style.css' ?>" media="screen">

    <!-- fonts -->
	  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'font-awesome-4.7.0'.DS.'css'.DS.'font-awesome.min.css' ?>" media="screen">

	<!-- viewport for better responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

  </head>

  <noscript>JavaScript is Disabled. Please put it on.</noscript>

  <body>

      <header>
          <div class="top_line">
              <p>Welcome <span><?php echo $_SESSION['user']['username']; ?></span></p>
              <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><button>log<i class="fa fa-power-off" aria-hidden="true"></i>ut</button></a>
          </div>
          <div id="burger_menu">≡</div>
          <nav id="nav_bar" class="nav_bar">
              <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/comments'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Comments</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
          </nav>
      </header>

      <div id="loader"></div>

    <?php include 'app'.DS.App::$prefix.DS.'views'.DS.$this->view.'.view.php'; ?>

    <!-- JS -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'js'.DS.'scripts.js' ?>"></script>
    <script src="https://cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
  </body>
</html>
