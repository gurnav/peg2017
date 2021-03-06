<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_NAME; ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'css'.DS.'style_back.css' ?>" media="screen">

    <!-- fonts -->
	  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'css'.DS.'font-awesome'.DS.'css'.DS.'font-awesome.min.css' ?>" media="screen">

	<!-- viewport for better responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

  </head>

  <noscript>JavaScript is Disabled. Please put it on.</noscript>

  <body>

      <header>
          <div class="top_line">
              <p>Welcome <span><?php echo $_SESSION['user']['username']; ?></span></p>
              <p><i class="fa fa-home" aria-hidden="true"></i> <a href="<?php echo BASE_URL; ?>" style="color: #fff; text-decoration: none">HomePage</a></p>
              <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><i class="fa fa-power-off" aria-hidden="true"></i></a>
          </div>
          <div id="burger_menu">≡</div>
          <nav id="nav_bar" class="nav_bar">
              <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
              <?php if ($_SESSION['user']['type'] === 'admin'): ?>
                  <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
              <?php endif ?>
              <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/comments'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Comments</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/management'; ?>"><i class="fa fa-handshake-o" aria-hidden="true"></i><span>Forum Management</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/messages'; ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><span>Messages</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/threads'; ?>"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i><span>Threads</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/topics'; ?>"><i class="fa fa-server" aria-hidden="true"></i><span>Topics</span></a></li>
              <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
          </nav>
      </header>

      <div id="loader"></div>

    <?php include 'app'.DS.App::$prefix.DS.'views'.DS.$this->view.'.view.php'; ?>

    <!-- JS -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo (SUB_SITE === true ? PATH_RELATIVE : '/').'public'.DS.'assets'.DS.'js'.DS.'scripts_back.js' ?>"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
</body>
</html>
