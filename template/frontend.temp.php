<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php $app->title ?></title>
    <meta name="description" content="description">

    <link rel="stylesheet" href="<?php echo PATH_RELATIVE; ?>css/bootstrap/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo PATH_RELATIVE; ?>css/bootstrap/bootstrap-theme.min.css" media="screen">

  </head>
  <body>

    <?php include 'app/Views/'.$this->view.'.view.php'; ?>

    <script type="text/javascript" src="<?php echo PATH_RELATIVE; ?>js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH_RELATIVE; ?>js/bootstrap/bootstrap.min.js"></script>
  </body>
</html>
