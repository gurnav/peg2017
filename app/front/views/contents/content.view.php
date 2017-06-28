<div class="body_item">
	<article class="article_solo" >
		<header>
		<h1><?php echo $content->getTitle(); ?></h1>
		<!-- <span></span> -->
		</header>
		<img src="<?php echo $content->getTitle(); ?>">
		<p class="description"><?php echo $content->getContent(); ?></p>
	</article>

	<div class="article_solo commentaries">
			<header>
			<h2>Commentaries : </h2>
			</header>
			<?php foreach ($comments as $comment): ?>
				<?php $user = $comment->getUserByComments(); ?>
				<div class="comment">
					<div class="profil_area">
						<h4><a href="<?php echo BASE_URL.'profile/'.strtolower($user->getUsername()); ?>">
							<?php echo $user->getUsername(); ?></a>
						</h4>
						<img src="<?php echo UPLOADS_DIR_USERS.$user->getUserImg(); ?>">
					</div>
					<div class="text_area">
						<p><?php echo $comment->getContent(); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if (isset($_SESSION['user'])): ?>
			<!-- Send a comments with CKEditor -->
		<?php endif; ?>
</div>
