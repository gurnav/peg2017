<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo App::$title ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'app.css' ?>" media="screen">
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'css'.DS.'main.css' ?>" media="screen">

  </head>
  <body>

    <?php include 'app'.DS.App::$prefix.DS.'Views'.DS.$this->view.'.view.php'; ?>

    <script type="text/javascript" src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'js'.DS.'menu.js' ?>"></script>
  </body>
</html>
