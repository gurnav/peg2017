<h3>Here you can register in our awesome site !</h3>

<?php echo $user_form; ?>

<?php if (isset($errors)): ?>
  <?php for($i = 0; $i < count($errors); $i += 1): ?>
    <p><?php echo $errors[$i] ?></p>
  <?php endfor ?>
<?php endif ?>
