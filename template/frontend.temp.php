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

    <?php include 'app'.DS.App::$prefix.DS.'views'.DS.$this->view.'.view.php'; ?>

    <!-- JS -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'js'.DS.'scripts.js' ?>"></script>
  </body>
</html>
