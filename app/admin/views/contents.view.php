<header>
    <div class="top_line">
        <p>Welcome <span><?php echo $_SESSION['admin']; ?></span></p>
        <button>Logout</button>
    </div>
    <div id="burger_menu">≡</div>
    <nav id="nav_bar" class="nav_bar">
        <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
    </nav>
</header>

<div id="loader"></div>

<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Pages &amp; Articles</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Pages &amp; Articles</caption>
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>type</th>
                <th>Author</th>
                <th>Date Publication</th>
                <th>Verification</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contents as $content): ?>
                <tr>
                    <td><?php echo $content['id']; ?></td>
                    <td><?php echo $content['title']; ?></td>
                    <td><?php echo $content['type']; ?></td>
                    <td><?php echo $content['username']; ?></td>
                    <td><?php echo $content['date_inserted']; ?></td>
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
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>

