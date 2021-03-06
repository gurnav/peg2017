<div class="body_item">
    <article class="presentation">
        <h2>Welcome <?php echo $user->getUsername(); ?></h2>
        <br>
        <p class="description">You can consult or modify your profile here.</p>
        <br>
    </article>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeUsername'; ?>" method="post">
        <span>Username : </span>
        <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
        <input class="profile_edit" type="submit" value="Change username">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeLastname'; ?>" method="post">
        <span>Lastname : </span>
        <input type="text" name="lastname" value="<?php echo $user->getLastname(); ?>">
        <input class="profile_edit" type="submit" value="Change lastname">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeFirstname'; ?>" method="post">
        <span>Firstname : </span>
        <input type="text" name="firstname" value="<?php echo $user->getFirstname(); ?>">
        <input class="profile_edit" type="submit" value="Change firstname">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeNewsletters'; ?>" method="post">
        <span>Newsletters : </span>
        <input type="radio" name="gender" value="1" <?php if ($user->getNewsletters() == 1) echo "checked" ?>> Subscribe<br>
        <input type="radio" name="gender" value="0" <?php if ($user->getNewsletters() == 0) echo "checked" ?>> Don't subscribe<br>
        <input class="profile_edit" type="submit" value="Change subscribe status">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeEmail'; ?>" method="post">
        <span>Email : </span>
        <input type="text" name="email" value="<?php echo $user->getEmail(); ?>">
        <input class="profile_edit" type="submit" value="Change email">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changePassword'; ?>" method="post">
        <span>Password : </span>
        <input type="password" name="password">
        <br>
        <span>Password confirmation : </span>
        <input type="password" name="password_conf">
        <br>
        <span>New Password : </span>
        <input type="password" name="new_password">
        <br>
        <input class="profile_edit" type="submit" value="Change password">
    </form>
    <br>

    <form class="form_user" action="<?php echo BASE_URL.'profile/changeImg'; ?>" method="post" enctype="multipart/form-data">
        <span>Image profile : </span>
        <input type="file" name="user_img">
        <input class="profile_edit" type="submit" value="Change image">
    </form>
    <br>
</div>

<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div class="simple_error">
            <p><?php echo $error ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
