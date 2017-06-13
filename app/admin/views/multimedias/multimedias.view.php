<header>
  <div class="top_line">
    <p>Welcome <span><?php echo $_SESSION['admin']['username']; ?></span></p>
    <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><button>log<i class="fa fa-power-off" aria-hidden="true"></i>ut</button></a>
  </div>
  <div id="burger_menu">≡</div>
  <nav id="nav_bar" class="nav_bar">
    <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/comments'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Comments</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
  </nav>
</header>

<section class="information_panel">

      <div id="loader"></div>

      <div class="path">
          <p><i class="fa fa-home" aria-hidden="true"></i> > Users</p>
      </div>

      <div class="all_icon">
			<h1><span>Photos</span><span>Videos</span><button title="Add Photo or Video"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></h1>

            <?php foreach ($medias as $media): ?>

                <div>
    				<img src="<?php echo ROUTE_DIR_CONTENTS.$media['path']; ?>" alt="<?php echo $media['name']; ?>" >
    				<i class="fa fa-camera" aria-hidden="true"></i>
    				<button title="Zoom" class="Zoom"><i class="fa fa-search" aria-hidden="true"></i></button>
    				<a href="deleteImage.html" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
    				<h2>photo<span></span></h2>
    			</div>

            <?php endforeach ?>

      </div>

      <div id="my_zoom">
			<div><img src=""></div>
			<button title="Close" id="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
	  </div>

  </section>
