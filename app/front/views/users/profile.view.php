<h2>Welcome <?php echo $user->getUsername(); ?></h2>
<br>

<p>You can consult or modify your profile here.</p>
<br>

<form action="<?php echo BASE_URL.'profile/changeUsername'; ?>" method="post">
    <span>Username : </span>
    <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
    <input type="submit" value="Change username">
</form>
<br>

<form action="<?php echo BASE_URL.'profile/changeLastname'; ?>" method="post">
    <span>Lastname : </span>
    <input type="text" name="lastname" value="<?php echo $user->getLastname(); ?>">
    <input type="submit" value="Change lastname">
</form>
<br>

<form action="<?php echo BASE_URL.'profile/changeFirstname'; ?>" method="post">
    <span>Firstname : </span>
    <input type="text" name="firstname" value="<?php echo $user->getFirstname(); ?>">
    <input type="submit" value="Change firstname">
</form>
<br>

<form action="<?php echo BASE_URL.'profile/changeEmail'; ?>" method="post">
    <span>Email : </span>
    <input type="text" name="email" value="<?php echo $user->getEmail(); ?>">
    <input type="submit" value="Change email">
</form>
<br>

<form action="<?php echo BASE_URL.'profile/changePassword'; ?>" method="post">
    <span>Password : </span>
    <input type="password" name="password">
    <br>
    <span>Password confirmation : </span>
    <input type="password" name="password_conf">
    <br>
    <span>New Password : </span>
    <input type="password" name="new_password">
    <br>
    <input type="submit" value="Change password">
</form>
<br>

<form action="<?php echo BASE_URL.'profile/changeImg'; ?>" method="post">
    <span>Image profile : </span>
    <input type="file" name="user_img">
    <input type="submit" value="Change image">
</form>
<br>

<?php if (isset($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
