<section xmlns="http://www.w3.org/1999/html">
    <div>
        <h2>Create Form</h2>

        <form class=<?php echo $content_form_factory["options"]["class"] ?>
              action=<?php echo $content_form_factory["options"]["action"] ?>
              method=<?php echo $content_form_factory["options"]["method"] ?>
              id=<?php echo $content_form_factory["options"]["method"] ?> >



            <?php foreach ($content_form_factory['struct'] as $name => $attribute): ?>
                <?php if($attribute['type'] === 'text'): ?>
                    <input type="<?php echo $attribute['type'] ?>"
                        <? if(isset($attribute['name'])) {
                            echo "name=\"".$attribute['name']."\"";} ?>

                    </input>

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
        </form>
    </div>
</section>