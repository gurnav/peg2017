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
        <p><i class="fa fa-home" aria-hidden="true"></i> > Pages &amp; Articles</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Pages &amp; Articles<a href="<?php echo BASE_URL.'admin/contents/add'; ?>"><button title="Create content"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Type</th>
                <th>Content</th>
                <th>Date Publication</th>
                <th>Username</th>
                <th>Verification</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contents as $content): ?>
                    <td><?php echo $content['id']; ?></td>
                    <td><?php echo $content['title']; ?></td>
                    <td><?php echo $content['type']; ?></td>
                    <td><?php echo $content['content']; ?></td>
                    <td><?php echo $content['date_inserted']; ?></td>
                    <td><?php echo $content['username']; ?></td>
                    <?php
                    if($content['status'] == -1) {
                        $status = 'rejected';
                    }

                    if($content['status'] == 0) {
                        $status = 'pending';
                    }

                    if($content['status'] == 1) {
                        $status = 'done';
                    }

                    echo "<td><button class=".$status.">".ucfirst($status)."</button></td>";
                    ?>
                    <a href="<?php echo BASE_URL.'admin/contents/update/'.$content['id']; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                    <a href="<?php echo BASE_URL.'admin/contents/delete/'.$content['id']; ?>"><button title="Delete"><i class="fa fa-times" aria-hidden="true"></i></button></a>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>


