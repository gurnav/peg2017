<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Topics > Subscribe to Newsletter</p>
    </div>

    <div class="only_one">
        <h2>Subscribe to Newsletter</h2>

        <form class="major_form"
              method="<?php echo $admin_register_newsletter['options']['method']; ?>"
              action="<?php echo $admin_register_newsletter['options']['action']; ?>"
            <?php if(isset($admin_register_newsletter["options"]["class"])) echo "class=\"".$admin_register_newsletter["options"]["class"]."\" " ?>
            <?php if(isset($admin_register_newsletter["options"]["id"])) echo "id=\"".$admin_register_newsletter["options"]["id"]."\" " ?>
              enctype="<?php echo $admin_register_newsletter['options']['enctype']; ?>">

            <?php foreach ($admin_register_newsletter['struct'] as $name => $attribute): ?>

            <?php if($attribute['type'] === 'text') : ?>

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

            <input type="submit" value="<?php echo $admin_register_newsletter["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>