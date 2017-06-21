<header>
    <div class="top_line">
        <p>Welcome <span><?php echo $_SESSION['admin']['username']; ?></span></p>
        <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><button>Logout</button></a>
    </div>
    <div id="burger_menu">≡</div>
    <nav id="nav_bar" class="nav_bar">
        <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
        <li ><a href="<?php echo BASE_URL.'admin/management'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Forum Management</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/messages'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Messages</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/threads'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Threads</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/topics'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Topics</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/newsletters'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Newsletters</span></a></li>


    </nav>
</header>

<section class="information_panel">
    <div id="loader"></div>
    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Topics > Create Topic</p>
    </div>

    <div class="only_one">
        <h2>Create or modify Topic</h2>

        <form class="major_form"
            method="<?php echo $admin_register_topic['options']['method']; ?>"
            action="<?php echo $admin_register_topic['options']['action']; ?>"
            <?php if(isset($admin_register_topic["options"]["class"])) echo "class=\"".$admin_register_topic["options"]["class"]."\" " ?>
            <?php if(isset($admin_register_topic["options"]["id"])) echo "id=\"".$admin_register_topic["options"]["id"]."\" " ?>
            enctype="<?php echo $admin_register_topic['options']['enctype']; ?>">

            <?php foreach ($admin_register_topic['struct'] as $name => $attribute): ?>

                <?php if($attribute['type'] === 'text'): ?>

                    <label><?php echo $attribute["label"]; ?>
                        <input
                            type="<?php echo $attribute['type']; ?>" name="<?php echo $name; ?>"
                            <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                            <?php if(isset($attribute['value'])) echo "value=\"".$attribute['value']."\" " ?>
                        >
                    </label>
                    <br>

                <?php endif; ?>

                <?php if($attribute['type'] === 'textarea'): ?>
                    <div class="super_editor">
                        <span class="editor_span"><?php echo $attribute["label"]; ?></span>
                        <textarea name="<?php echo $name; ?>"
                            <?php if(isset($attribute["placeholder"])) echo "placeholder=\"".$attribute["placeholder"]."\" " ?>
                            <?php if(isset($attribute["required"])) echo "required=\"".$attribute["required"]."\" " ?>
                                  id="textarea"><?php if(isset($attribute['value'])) echo $attribute['value'] ?></textarea><br>
                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

            <input type="submit" value="<?php echo $admin_register_topic["options"]['submit']; ?>">

        </form>
    </div>
</section>


<?php if (isset($errors)): ?>
    <?php for($i = 0; $i < count($errors); $i += 1): ?>
        <p><?php echo $errors[$i] ?></p>
    <?php endfor ?>
<?php endif ?>

