<div class="body_item">
    <article class="presentation">
		<h1 class="page_title"><?php echo ucfirst($type); ?></h1>
		<p class="description">Here you can see all the <?php echo $type; ?> that we got on the website</p>
	</article>
    <?php for($i = 0; $i < sizeof($contents); $i += 3): ?>
        <div class="triple_items">
            <?php for($j = $i; $j < $i + 3; $j += 1): ?>
                <?php if(isset($contents[$j])): ?>
                    <article class="item">
        				<header>
        					<h2><?php echo $contents[$j]['title']; ?></h2>
        					<!-- <span></span> -->
        				</header>
        				<a href="<?php echo BASE_URL.'contents/'.$contents[$i]['type'].'/'.$contents[$i]['id']; ?>">
        				    <img src="<?php echo UPLOADS_DIR_CONTENTS.$contents[$i]['thumbnail']; ?>">
        				</a>
        			</article>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>
