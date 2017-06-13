<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="<?= $name ?>" content="<?= $description ?>">

    <? foreach ($css as $include): ?>
      <link rel="stylesheet" href="<?= PATH_RELATIVE . $include; ?>" media="screen">
    <? endforeach; ?>

  </head>
  <header>
    <nav>
      <? foreach ($nav as $menu => $item): ?>
        <a href="<?= $menu; ?>"><?= $item; ?></a>
      <? endforeach; ?>
    </nav>
  </header>
  <body>
