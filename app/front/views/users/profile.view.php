<div class="body_item">


	<div class="resume_profil" >
	<header>
		<h2>Your informations : </h2>
	</header>
		<div class="public banner_profile">
            <img src="<?php echo ROUTE_DIR_USERS.$user->getUserImg(); ?>">
		</div>

        <div class="public"><p>Your Informations</p></div>

		<div class="private" style="float: left;">
            <p><i class="fa fa-user" aria-hidden="true"></i> Username: <span><?php echo $user->getUsername(); ?></span></p>
			<p><i class="fa fa-tag" aria-hidden="true"></i> Firstname: <span><?php echo $user->getFirstname(); ?></span></p>
        </div>

        <div class="private" style="float: right;">
			<p><i class="fa fa-list-alt" aria-hidden="true"></i> Lastname: <span><?php echo $user->getLastname(); ?></span></p>
			<p><i class="fa fa-user" aria-hidden="true"></i> Email: <span><?php echo $user->getEmail(); ?></span></p>
        </div>

        <div class="public">
            <p>
                <a href="<?php echo BASE_URL.'profile/edit/'.$_SESSION['user']['username']; ?>"><i class="fa fa-cog" aria-hidden="true"></i> Edit</a>
            </p>
        </div>

	</div>


</div>
