<div class="body_item">
		<article class="presentation">
			<h1 class="page_title">Connection</h1>
			<p class="description">Here you can connect to your account</p>
		</article>

        <form class="form_user"
          method="<?php echo $user_form['options']['method']; ?>"
          action="<?php echo $user_form['options']['action']; ?>"
          <?php if(isset($user_form["options"]["class"])) echo "class=\"".$user_form["options"]["class"]."\" " ?>
          <?php if(isset($user_form["options"]["id"])) echo "id=\"".$user_form["options"]["id"]."\" " ?>
          enctype="<?php echo $user_form['options']['enctype']; ?>">

          <?php foreach ($user_form['struct'] as $name => $attribute): ?>

            <?php if($attribute['type'] === 'email' ||
                      $attribute['type'] === 'text' ||
                      $attribute['type'] === 'password'): ?>

                  <div>

                    <i class="<?php echo $attribute['i_class']; ?>" aria-hidden="true"></i>
                    <input
                    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                    <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                    <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                    <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                    >
                  </div>
            <?php endif; ?>

          <?php endforeach; ?>

          <input class="validate" type="submit" value="<?php echo $user_form["options"]['submit']; ?>">

    </form>

</div>

<div class="simple_error">
    <a href="<?php echo BASE_URL.'login/forgot_password' ?>"><p>Forgotten password ?</p></a>
</div>

<?php if(isset($error)): ?>
  <p><?php echo $error ?></p>
<?php endif ?>
