<div class="body_item">
	<article class="article_solo" >
		<header>
		<h1><?php echo $content->getTitle(); ?></h1>
		</header>
		<img src="<?php echo $content->getThumbnails_id(); ?>">
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
						<h4><a href="<?php echo BASE_URL.'profile/show/'.strtolower($user->getUsername()); ?>">
							<?php echo $user->getUsername(); ?></a>
						</h4>
						<img src="<?php echo ROUTE_DIR_USERS.$user->getUserImg(); ?>">
					</div>
					<div class="text_area">
						<p><?php echo $comment->getContent(); ?></p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if (isset($_SESSION['user']) && $content->getIsLikeable() == '1'): ?>
			<div class="article_solo">
				<header>
					<h2>Write a comment</h2>
				</header>

				<form class="make_commentaries" method="POST" action="<?php echo BASE_URL.'contents/sendComment'; ?>">
					<div class="super_editor">
						<textarea name="content" id="textarea" rows="10" cols="80"></textarea>
					</div>
					<div>
						<input type="hidden" name="content_id" value="<?php echo $content->getId(); ?>">
						<input class="send_commentaries" type="submit" value="Send it !">
					</div>
				</form>
			</div>
		<?php else : ?>
			<div class="article_solo">
				<header>
					<h2>Write a comment</h2>
				</header>

				<p>You have to be connected to post a comment.</p>

			</div>
		<?php endif; ?>
		<?php if (isset($errors)): ?>
			<div class="article_solo">
			<?php foreach($errors as $error): ?>
				<p><?php echo $error; ?></p>
			<?php endforeach ?>
			</div>
		<?php endif ?>
</div>
