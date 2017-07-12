<div class="body_item">
		<article class="presentation">
			<h1 class="page_title">Forgot Password</h1>
			<p class="description">Here you can get a new password</p>
		</article>

        <form class="form_user"
          method="<?php echo $fp_form['options']['method']; ?>"
          action="<?php echo $fp_form['options']['action']; ?>"
          <?php if(isset($fp_form["options"]["class"])) echo "class=\"".$fp_form["options"]["class"]."\" " ?>
          <?php if(isset($fp_form["options"]["id"])) echo "id=\"".$fp_form["options"]["id"]."\" " ?>
          enctype="<?php echo $fp_form['options']['enctype']; ?>">

          <?php foreach ($fp_form['struct'] as $name => $attribute): ?>

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

          <input class="validate" type="submit" value="<?php echo $fp_form["options"]['submit']; ?>">

    </form>

</div>

<?php if(isset($error)): ?>
  <p><?php echo $error ?></p>
<?php endif ?>
