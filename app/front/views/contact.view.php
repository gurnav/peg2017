
<div class="body_item">
    <article class="presentation">
        <h1 class="page_title">Contact</h1>
        <p class="description">Here you can contact us</p>
    </article>
    <form class="form_user"
          method="<?php echo $user_form['options']['method']; ?>"
          action="<?php echo $user_form['options']['action']; ?>"
        <?php if(isset($user_form["options"]["class"])) echo "class=\"".$user_form["options"]["class"]."\" " ?>
        <?php if(isset($user_form["options"]["id"])) echo "id=\"".$user_form["options"]["id"]."\" " ?>
          enctype="<?php echo $user_form['options']['enctype']; ?>">

        <?php foreach ($user_form['struct'] as $name => $attribute): ?>
            <?php if($attribute['type'] === 'email' ||
            $attribute['type'] === 'text' ||
            $attribute['type'] === 'password'): ?>

            <div>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <input type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                    <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                    <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                    <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                >
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="super_editor">
            <span class="editor_span">Message :</span>
            <input type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
               id="textarea" rows="10" cols="80">
        </div>

        <input class="validate" type="submit" value="<?php echo $user_form["options"]['submit']; ?>">
    </form>
</div>

<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <div class="simple_error">
            <p><?php echo $errors[$i] ?></p>
        </div>
    <?php endfor ?>
<?php endif ?>