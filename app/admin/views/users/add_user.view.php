<form
  method="<?php echo $admin_add_user_form['options']['method']; ?>"
  action="<?php echo $admin_add_user_form['options']['action']; ?>"
  <?php if(isset($admin_add_user_form["options"]["action"])) echo "action=\"".$admin_add_user_form["options"]["action"]."\" " ?>
  <?php if(isset($admin_add_user_form["options"]["class"])) echo "class=\"".$admin_add_user_form["options"]["class"]."\" " ?>
  <?php if(isset($admin_add_user_form["options"]["id"])) echo "id=\"".$admin_add_user_form["options"]["id"]."\" " ?>
  enctype="<?php echo $admin_add_user_form['options']['enctype']; ?>">

  <?php foreach ($admin_add_user_form['struct'] as $name => $attribute): ?>

    <?php if($attribute['type'] === 'email' ||
              $attribute['type'] === 'text' ||
              $attribute['type'] === 'password'): ?>

          <label><?php echo $attribute["label"]; ?>
            <input
            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
            <?php if(isset($admin_add_user_form["options"]["placeholder"])) echo "placeholder=\"".$admin_add_user_form["options"]["placeholder"]."\" " ?>
            <?php if(isset($admin_add_user_form["options"]["required"])) echo "required=\"".$admin_add_user_form["options"]["required"]."\" " ?>
            >
          </label>
          <br>
    <?php endif; ?>

    <?php if($attribute['type'] === 'checkbox'): ?>
      <?php foreach ($attribute['value'] as $value => $checked): ?>
        <input
        type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
        value="<?php echo $value; ?>" <?php if($checked === true) echo "checked"; ?>
        ><?php echo $value; ?><br>
      <?php endforeach; ?>
    <?php endif; ?>

  <?php endforeach; ?>

  <?php if($attribute['type'] === 'file'): ?>
    <label><?php echo $attribute['label']; ?>
    <input
    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
    ></label><br>
  <?php endif; ?>

  <input type="submit" value="<?php echo $admin_add_user_form["options"]['submit']; ?>">

</form>
