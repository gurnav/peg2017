<form
  method="<?php echo $admin_add_user_form['options']['method']; ?>"
  action="<?php echo $admin_add_user_form['options']['action']; ?>"
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
            <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
            <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
            >
          </label>
          <br>
    <?php endif; ?>

    <?php if($attribute['type'] === 'radio' && $name === 'user_rights'): ?>
      <label><?php echo $attribute["label"]; ?>
      <?php foreach ($attribute['value'] as $value => $rights): ?>
        <input
        type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
        value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
        ><?php echo $value; ?>
      <?php endforeach; ?>
      </label><br>
    <?php endif; ?>

    <?php if($attribute['type'] === 'radio' && $name === 'user_status'): ?>
      <label><?php echo $attribute["label"]; ?>
      <?php foreach ($attribute['value'] as $value => $rights): ?>
        <input
        type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
        value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
        ><?php echo $value; ?>
      <?php endforeach; ?>
    </label><br>
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


<?php if (isset($errors)): ?>
  <?php for($i = 0; $i < count($errors); $i += 1): ?>
    <p><?php echo $errors[$i] ?></p>
  <?php endfor ?>
<?php endif ?>
