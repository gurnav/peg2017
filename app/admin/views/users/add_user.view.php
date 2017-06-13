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
	<p><i class="fa fa-home" aria-hidden="true"></i> > Users > add or modify User</p>
</div>

    <div class="only_one">
      <h2>Add / Modify User</h2>

        <form class="major_form"
          method="<?php echo $admin_add_user_form['options']['method']; ?>"
          action="<?php echo $admin_add_user_form['options']['action']; ?>"
          <?php if(isset($admin_add_user_form["options"]["class"])) echo "class=\"".$admin_add_user_form["options"]["class"]."\" " ?>
          <?php if(isset($admin_add_user_form["options"]["id"])) echo "id=\"".$admin_add_user_form["options"]["id"]."\" " ?>
          enctype="<?php echo $admin_add_user_form['options']['enctype']; ?>">

          <?php foreach ($admin_add_user_form['struct'] as $name => $attribute): ?>

            <?php if($attribute['type'] === 'email' ||
                      $attribute['type'] === 'text' ||
                      $attribute['type'] === 'password'): ?>

                  <div>

                  <span><?php echo $attribute["label"]; ?></span>
                    <input
                    type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                    <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                    <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                    <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                    >
                  </div>
            <?php endif; ?>

            <?php if($attribute['type'] === 'radio' && $name === 'user_rights'): ?>
              <label><?php echo $attribute["label"]; ?>
              <?php foreach ($attribute['value'] as $value => $rights): ?>
                <input
                type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
                ><?php echo $value; ?>
              <?php endforeach; ?>
              </label><br>
            <?php endif; ?>

            <?php if($attribute['type'] === 'radio' && $name === 'user_status'): ?>
              <label><?php echo $attribute["label"]; ?>
              <?php foreach ($attribute['value'] as $value => $rights): ?>
                <input
                type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                value="<?php echo $rights; ?>" <?php if($attribute['checked'] == $rights) echo "checked"; ?>
                ><?php echo $value; ?>
              <?php endforeach; ?>
            </label><br>
            <?php endif; ?>

          <?php endforeach; ?>

          <?php if($attribute['type'] === 'file'): ?>
            <label><?php echo $attribute['label']; ?>
            <input
            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
            ></label><br>
          <?php endif; ?>

          <input type="submit" value="<?php echo $admin_add_user_form["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
  <?php for($i = 0; $i < count($errors); $i += 1): ?>
    <p><?php echo $errors[$i] ?></p>
  <?php endfor ?>
<?php endif ?>
