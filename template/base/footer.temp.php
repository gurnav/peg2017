
    <? foreach ($javascript as $include): ?>
      <script type="text/javascript" src="<?= PATH_RELATIVE . $include; ?>"></script>
    <? endforeach; ?>

  </body>

  <footer>
    <? foreach ($links as $link => $data): ?>
      <a href="<?= $link; ?>"><?= $data; ?></a>
    <? endforeach; ?>
  </footer>

</html>
