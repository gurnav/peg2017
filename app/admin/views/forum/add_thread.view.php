<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> >
            <a href="<?php echo BASE_URL.'admin/categories'; ?>">Threads</a> > Create or modify Thread</p>
    </div>

    <div class="only_one">
        <h2>Create or modify Thread</h2>

        <form class="major_form"
              method="<?php echo $admin_register_thread['options']['method']; ?>"
              action="<?php echo $admin_register_thread['options']['action']; ?>"
            <?php if(isset($admin_register_thread["options"]["class"])) echo "class=\"".$admin_register_thread["options"]["class"]."\" " ?>
            <?php if(isset($admin_register_thread["options"]["id"])) echo "id=\"".$admin_register_thread["options"]["id"]."\" " ?>
              enctype="<?php echo $admin_register_thread['options']['enctype']; ?>">

            <?php foreach ($admin_register_thread['struct'] as $name => $attribute): ?>

                <?php if($attribute['type'] === 'text'): ?>

                    <div class="center">
                        <label><?php echo $attribute["label"]; ?>
                        <input
                            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                            <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                            <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                        >
                        </label>
                        <br>
                    </div>

                <?php endif; ?>
                <?php if($attribute['type'] === 'textarea'): ?>
                    <div class="super_editor">
                        <span class="editor_span"><?php echo $attribute["label"]; ?></span>
                        <textarea name="<?php echo $name; ?>"
                            <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                                  id="textarea"><?php if(isset($attribute['value'])) echo $attribute['value'] ?></textarea><br>
                    </div>

                <?php endif; ?>

                <?php if($attribute['type'] === 'selected'): ?>
                    <div class="center">
                        <label><?php echo $attribute["label"]; ?>
                            <select name="<?php echo $name; ?>">
                                <?php if(isset($attribute['value']))
                                    foreach ($attribute['value'] as $key => $value) {
                                        ?><option><?php echo $value; ?></option><?php
                                    }
                                ?>
                            </select>
                        </label>
                    </div>
                    <br>
                <?php endif; ?>

            <?php endforeach; ?>

            <input type="submit" class="button_style" value="<?php echo $admin_register_thread["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>

