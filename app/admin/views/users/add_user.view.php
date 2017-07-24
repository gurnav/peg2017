<section class="information_panel">
<div class="path">
	<p><i class="fa fa-home" aria-hidden="true"></i> >
        <a href="<?php echo BASE_URL.'admin/users'; ?>">Users</a> > add or modify User</p>
</div>

    <div class="only_one">
      <h2>Add / Modify User</h2>

        <form class="major_form"
          method="<?php echo $admin_add_user_form['options']['method']; ?>"
          action="<?php echo $admin_add_user_form['options']['action']; ?>"
          <?php if(isset($admin_add_user_form["options"]["class"])) echo "class=\"".$admin_add_user_form["options"]["class"]."\" " ?>
          <?php if(isset($admin_add_user_form["options"]["id"])) echo "id=\"".$admin_add_user_form["options"]["id"]."\" " ?>
          enctype="<?php echo $admin_add_user_form['options']['enctype']; ?>">

          <?php foreach ($admin_add_user_form['struct'] as $name => $attribute): ?>

            <?php if($attribute['type'] === 'email' ||
                      $attribute['type'] === 'text' ||
                      $attribute['type'] === 'password'): ?>

                  <div>

                  <span><?php echo $attribute["label"]; ?></span>
                    <input
                    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                    <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                    <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                    <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                    >
                  </div>
            <?php endif; ?>

            <?php if($attribute['type'] === 'radio'): ?>
              <div class="center">
                  <label><?php echo $attribute["label"]; ?>
                  <?php foreach ($attribute['value'] as $value => $rights): ?>
                    <input
                    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                    value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
                    ><?php echo $value; ?>
                  <?php endforeach; ?>
                  </label>
              </div>
              <br>
            <?php endif; ?>

          <?php endforeach; ?>

          <?php if($attribute['type'] === 'file'): ?>
            <div class="div-file">
                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                <label class="label-file"><?php echo $attribute['label']; ?>
                    <input class="input-file" type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>">
                </label><br>
            </div>
          <?php endif; ?>

          <input type="submit" class="button_style" value="<?php echo $admin_add_user_form["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
  <?php for($i = 0; $i < count($errors); $i += 1): ?>
    <p><?php echo $errors[$i] ?></p>
  <?php endfor ?>
<?php endif ?>
