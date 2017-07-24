<div class="body_item">
		<article class="presentation">
			<h1 class="page_title">Inscription</h1>
			<p class="description">Here you can register yourself and be a member of our website</p>
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

			<?php if($attribute['type'] === 'radio'): ?>
				<div>
                    <label><i class="<?php echo $attribute['i_class']; ?>" aria-hidden="true"></i> Newsletter</label>
                    <?php foreach ($attribute['value'] as $value => $rights): ?>
                      <div class="radio_newsletter">
                        <input
                        type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                        value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
                        >
                        <?php echo $value; ?>
                      </div>
	                <?php endforeach; ?>
				</div>
 		    <?php endif; ?>


          <?php endforeach; ?>

          <?php if($attribute['type'] === 'file'): ?>
            <div class="div-file">
              <i class="<?php echo $attribute['i_class']; ?>" aria-hidden="true"></i>
                <label class="label-file"><?php echo $attribute['label']; ?>
                    <input class="input-file" type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>">
                </label>
            </div>
          <?php endif; ?>

          <input class="validate" type="submit" value="<?php echo $user_form["options"]['submit']; ?>">

        </form>
    </div>


<?php if (isset($errors)): ?>
  <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <div class="simple_error">
            <p><?php echo $errors[$i] ?></p>
        </div>
  <?php endfor ?>
<?php endif ?>
