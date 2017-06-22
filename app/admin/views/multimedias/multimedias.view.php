<section class="information_panel">

      <div class="path">
          <p><i class="fa fa-home" aria-hidden="true"></i> > Users</p>
      </div>

      <div class="all_icon">
			<h1><span>Photos</span><span>Videos</span><a href="<?php echo BASE_URL.'admin/medias/add'; ?>"><button title="Add Photo or Video"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></h1>

            <?php foreach ($medias as $media): ?>

                <div>
    				<img src="<?php echo ROUTE_DIR_CONTENTS.$media['path']; ?>" alt="<?php echo $media['name']; ?>" >
    				<i class="fa fa-camera" aria-hidden="true"></i>
    				<button title="Zoom" class="Zoom"><i class="fa fa-search" aria-hidden="true"></i></button>
    				<a href="<?php echo BASE_URL."admin/medias/delete/".$media['id'] ?>" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
    				<h2>photo<span></span></h2>
    			</div>

            <?php endforeach ?>

      </div>

      <div id="my_zoom">
			<div><img src=""></div>
			<button title="Close" id="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
	  </div>

  </section>
