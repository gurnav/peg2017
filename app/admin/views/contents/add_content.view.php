<section class="information_panel">
    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Contents > modifyContent</p>
    </div>

    <div class="only_one">
        <h2>Modify Content</h2>

        <form class="major_form"
              method="<?php echo $admin_register_content['options']['method']; ?>"
              action="<?php echo $admin_register_content['options']['action']; ?>"
            <?php if(isset($admin_register_content["options"]["class"])) echo "class=\"".$admin_register_content["options"]["class"]."\" " ?>
            <?php if(isset($admin_register_content["options"]["id"])) echo "id=\"".$admin_register_content["options"]["id"]."\" " ?>
              enctype="<?php echo $admin_register_content['options']['enctype']; ?>">

            <?php foreach ($admin_register_content['struct'] as $name => $attribute): ?>

                <?php if($attribute['type'] === 'email' ||
                    $attribute['type'] === 'text' ||
                    $attribute['type'] === 'password'): ?>

                <div>
                    <span><?php echo $attribute["label"]; ?><span>
                    <input
                            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                        <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                        <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                        <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                    >
                    <br>
                </div>
                <?php endif; ?>

                <?php if($attribute['type'] === 'select'): ?>
                    <div>
                        <span><?php echo $attribute["label"]; ?><span>
                        <select name="<?php echo $name; ?>"
                            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                            >
                            <?php foreach ($categories as $value): ?>
                                <option value="<?php echo strtolower($value['name']); ?>"
                                    <?php if ($attribute['value'] === $value['name']) echo 'selected'; ?>>
                                    <?php echo strtolower($value['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
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

            <input type="submit" value="<?php echo $admin_register_content["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>
