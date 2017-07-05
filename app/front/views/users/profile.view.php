<div class="body_item">


	<div class="resume_profil" >
	<header>
		<h2>Your informations : </h2>
	</header>
		<div class="public">
			<p><img src="<?php echo ROUTE_DIR_USERS.$user->getUserImg(); ?>"><i class="fa fa-user" aria-hidden="true"></i> Username: <span><?php echo $user->getUsername(); ?></span></p>
		</div>
		<div class="private">
			<p><i class="fa fa-tag" aria-hidden="true"></i> Firstname: <span><?php echo $user->getFirstname(); ?></span></p>
			<p><i class="fa fa-list-alt" aria-hidden="true"></i> Lastname: <span><?php echo $user->getLastname(); ?></span></p>
			<p><i class="fa fa-user" aria-hidden="true"></i> Email: <span><?php echo $user->getEmail(); ?></span></p>
			<!-- <p><i class="fa fa-key" aria-hidden="true"></i> Password: <span>********</span></p> -->
		</div>
	</div>


</div>
