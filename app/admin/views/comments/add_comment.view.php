<section class="information_panel">
    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Comments > addComment</p>
    </div>

    <div class="only_one">
        <h2>Add Comment</h2>

    <form class="major_form"
        method="<?php echo $admin_register_comment['options']['method']; ?>"
        action="<?php echo $admin_register_comment['options']['action']; ?>"
    <?php if(isset($admin_register_comment["options"]["class"])) echo "class=\"".$admin_register_comment["options"]["class"]."\" " ?>
    <?php if(isset($admin_register_comment["options"]["id"])) echo "id=\"".$admin_register_comment["options"]["id"]."\" " ?>
        enctype="<?php echo $admin_register_comment['options']['enctype']; ?>">

    <?php foreach ($admin_register_comment['struct'] as $name => $attribute): ?>

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

    <input type="submit" value="<?php echo $admin_register_comment["options"]['submit']; ?>">

    </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>
