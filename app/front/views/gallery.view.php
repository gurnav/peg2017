<div class="body_item">
    <article class="presentation">
        <h1 class="page_title">Gallery</h1>
        <p class="description">Here you can all the photos/videos avaiable on the website</p>
    </article>
    <div class="img_list">
        <?php foreach ($medias as $media): ?>
            <div>
                <img src="<?php echo ROUTE_DIR_CONTENTS.$media['path']; ?>"
                    alt="<?php echo $media['name']; ?>">
                <h4><?php echo $media['name']; ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
