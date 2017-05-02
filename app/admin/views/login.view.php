
<section class="connexion_back">
		<div>
			<h2>Connexion back</h2>
      <?php echo $user_form; ?>
    </div>
</section>

<?php if(isset($error)): ?>
  <p><?php echo $error ?></p>
<?php endif ?>
