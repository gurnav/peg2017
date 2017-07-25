<div class="body_item">
    <article class="presentation">
		<h1 class="page_title"><?php echo ucfirst($type); ?></h1>
		<p class="description">Here you can see all the <?php echo $type; ?> that we got on the website</p>
	</article>

    <!-- Filter -->
    <div class="filters">
        <div class="content">
            <form class="filter_form"
                  method="<?php echo $search_form['options']['method']; ?>"
                  action="<?php echo $search_form['options']['action']; ?>"
                <?php if(isset($search_form["options"]["class"])) echo "class=\"".$search_form["options"]["class"]."\" " ?>
                <?php if(isset($search_form["options"]["id"])) echo "id=\"".$search_form["options"]["id"]."\" " ?>
                  enctype="<?php echo $search_form['options']['enctype']; ?>">
                <i class="fa fa-search" aria-hidden="true"></i>

                <?php foreach ($search_form['struct'] as $name => $attribute): ?>

                    <?php if ($attribute['type'] === 'select'): ?>
                        <?php if (isset($attribute["label"])) echo "<label>".$attribute["label"]."</label>"; ?>
                        <select name="<?php echo $name; ?>">
                            <?php foreach ($attribute['value'] as $value): ?>
                                <option value="<?php echo $value; ?>"><?php echo ucfirst($value); ?></option>
                            <?php endforeach ?>
                        </select>

                    <?php endif ?>

                    <?php if($attribute['type'] === 'email' ||
                        $attribute['type'] === 'text' ||
                        $attribute['type'] === 'password'): ?>

                            <?php if (isset($attribute["label"])) echo "<label>".$attribute["label"]."</label>"; ?>
                            <input
                                    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                                <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                                <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                                <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                            >
                    <?php endif; ?>

                <?php endforeach; ?>

                <input type="submit" class="submit" value="<?php echo $search_form["options"]['submit']; ?>">

            </form>
        </div>
    </div>
    <!-- Fin filter -->
    <?php if (isset($contents) && !empty($contents)): ?>
        <?php for($i = 0; $i < sizeof($contents); $i += 3): ?>
            <div class="triple_items">
                <?php for($j = $i; $j < $i + 3; $j += 1): ?>
                    <?php if(isset($contents[$j])): ?>
                        <article class="item">
            				<header>
            					<h2><?php echo $contents[$j]->title; ?> | <?php echo $contents[$j]->category_name; ?></h2>
            				</header>
            				<a href="<?php echo BASE_URL.'contents/'.$contents[$j]->type.'/'.$contents[$j]->id; ?>">
            				    <img src="<?php echo ROUTE_DIR_CONTENTS.$contents[$j]->thumbnails; ?>">
            				</a>
            			</article>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>

    <?php else: ?>
        <div><p class="simple_error">No contents found ...</p></div>
    <?php endif ?>

</div>
