<form
    method="<?php echo $admin_register_category['options']['method']; ?>"
    action="<?php echo $admin_register_category['options']['action']; ?>"
    <?php if(isset($admin_register_category["options"]["class"])) echo "class=\"".$admin_register_category["options"]["class"]."\" " ?>
    <?php if(isset($admin_register_category["options"]["id"])) echo "id=\"".$admin_register_category["options"]["id"]."\" " ?>
    enctype="<?php echo $admin_register_category['options']['enctype']; ?>">

    <?php foreach ($admin_register_category['struct'] as $name => $attribute): ?>

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

    <?php endforeach; ?>

    <input type="submit" value="<?php echo $admin_register_category["options"]['submit']; ?>">

</form>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>
