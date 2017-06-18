<section class="information_panel">
    <div class="path">
    	<p><i class="fa fa-home" aria-hidden="true"></i> > Users > add multimedia</p>
    </div>

    <div class="only_one">
      <h2>Add Multimedias</h2>

        <form class="major_form"
          method="<?php echo $admin_add_multimedia_form['options']['method']; ?>"
          action="<?php echo $admin_add_multimedia_form['options']['action']; ?>"
          <?php if(isset($admin_add_multimedia_form["options"]["class"])) echo "class=\"".$admin_add_multimedia_form["options"]["class"]."\" " ?>
          <?php if(isset($admin_add_multimedia_form["options"]["id"])) echo "id=\"".$admin_add_multimedia_form["options"]["id"]."\" " ?>
          enctype="<?php echo $admin_add_multimedia_form['options']['enctype']; ?>">

          <?php foreach ($admin_add_multimedia_form['struct'] as $name => $attribute): ?>

            <?php if($attribute['type'] === 'text'): ?>

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

          <?php endforeach; ?>

          <?php if($attribute['type'] === 'file'): ?>
            <label><?php echo $attribute['label']; ?>
            <input type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
            ></label><br>
          <?php endif; ?>

          <input type="submit" value="<?php echo $admin_add_multimedia_form["options"]['submit']; ?>">

        </form>
    </div>
</section>

  <?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
      <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
  <?php endif ?>
