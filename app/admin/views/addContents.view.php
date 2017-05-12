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
                    <?php for($i = 0; $i < 3; $i += 1): ?>
                        <?php if($i === 0) { $value = "foo"; } if($i === 1) { $value = "foo"; } if($i === 2) { $value = "foo"; } ?>
                            <input type="<?php $attribute['type'] ?>" name="vehicle" value="<?php echo $value?>"><br>
                    <?php endfor; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </form>
    </div>
</section>