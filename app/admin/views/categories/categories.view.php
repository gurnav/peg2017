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
        <li><a href="<?php echo BASE_URL.'admin/commentaries'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Commentaires</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
    </nav>
</header>


<section class="information_panel">

    <div id="loader"></div>

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Categories</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Categories<a href="<?php echo BASE_URL.'admin/categories/add'; ?>"><button title="Create category"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Date Publication</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo $category['name']; ?></td>
                <td><?php echo $category['description']; ?></td>
                <td><?php echo $category['date_inserted']; ?></td>
                <td><?php echo $category['username']; ?></td>

                <a href="<?php echo BASE_URL.'admin/categories/update/'.$category['id']; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                <a href="<?php echo BASE_URL.'admin/categories/delete/'.$category['id']; ?>"><button title="Delete"><i class="fa fa-times" aria-hidden="true"></i></button></a>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>


