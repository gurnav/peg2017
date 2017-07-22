<div class="body_item">
    <article class="presentation">
		<h1 class="page_title"><?php echo ucfirst($type); ?></h1>
		<p class="description">Here you can see all the <?php echo $type; ?> that we got on the website</p>
	</article>
    <!-- Filter -->
    <div class="filters">
        <div class="content">
            <form name="filter_form" action="" method="get" id="filter_form_artistes">


                <label>Trier par type</label>
                <select name="type">
                    <option value="all" <?php if(!empty($_GET['type']) && $_GET['type'] == 'all' ) { echo 'selected'; } ?>>All</option>
                    <option value="news" <?php if(!empty($_GET['type']) && $_GET['type'] == 'electro' ) { echo 'selected'; } ?>>News</option>
                    <option value="article" <?php if(!empty($_GET['type']) && $_GET['type'] == 'pop' ) { echo 'selected'; } ?>>Articles</option>
                    <option value="page" <?php if(!empty($_GET['type']) && $_GET['type'] == 'rock' ) { echo 'selected'; } ?>>Pages</option>
                </select>

                <select name="type">
                    <option value="all" <?php if(!empty($_GET['type']) && $_GET['type'] == 'all' ) { echo 'selected'; } ?>>All</option>
                    <option value="category" <?php if(!empty($_GET['type']) && $_GET['type'] == 'electro' ) { echo 'selected'; } ?>>Category</option>
                    <option value="title" <?php if(!empty($_GET['type']) && $_GET['type'] == 'pop' ) { echo 'selected'; } ?>>Title</option>
                </select>

                <input type="text" name="search" placeholder="Search..">
                <input class="submit" type="submit" value="Valider" />
            </form>
        </div>
    </div>
    <!-- Fin filter -->
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
