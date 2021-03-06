<section class="information_panel">
    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > <a href="<?php echo BASE_URL.'admin/contents'; ?>">Users</a> > Send newsletters</p>
    </div>

    <div class="only_one">
        <h2>Send a newsletters</h2>

        <form class="major_form"
              method="<?php echo $admin_newsletters['options']['method']; ?>"
              action="<?php echo $admin_newsletters['options']['action']; ?>"
            <?php if(isset($admin_newsletters["options"]["class"])) echo "class=\"".$admin_newsletters["options"]["class"]."\" " ?>
            <?php if(isset($admin_newsletters["options"]["id"])) echo "id=\"".$admin_newsletters["options"]["id"]."\" " ?>
              enctype="<?php echo $admin_newsletters['options']['enctype']; ?>">

            <?php foreach ($admin_newsletters['struct'] as $name => $attribute): ?>

                <?php if($attribute['type'] === 'email' ||
                    $attribute['type'] === 'text' ||
                    $attribute['type'] === 'password'): ?>

                <div class="center">
                    <label><?php echo $attribute["label"]; ?><label>
                    <input
                            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                        <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                        <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                        <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                    >
                    <br>
                </div>
                <?php endif; ?>

                <?php if($attribute['type'] === 'textarea'): ?>
                    <div class="super_editor">
                        <span class="editor_span"><?php echo $attribute["label"]; ?></span>
                        <textarea name="<?php echo $name; ?>"
                        <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                        <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                        id="textarea"><?php if(isset($attribute['value'])) echo $attribute['value']; ?></textarea><br>
                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

            <input class="button_style" type="submit" value="<?php echo $admin_newsletters["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>
