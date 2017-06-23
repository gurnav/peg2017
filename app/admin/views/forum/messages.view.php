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
        <li><a href="<?php echo BASE_URL.'admin/management'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Forum Management</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/messages'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Messages</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/threads'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Threads</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/topics'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Topics</span></a></li>
        <li><a href="<?php echo BASE_URL.'admin/newsletters'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Newsletters</span></a></li>


    </nav>
</header>


<section class="information_panel">

    <div id="loader"></div>

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Messages</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Messages<a href="<?php echo BASE_URL.'admin/messages/add'; ?>"><button title="Create message"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Thread</th>
                <th>Content</th>
                <th>Action</th>
                <!-- <th class="important_one">Status</th> -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td><?php echo $message['username']; ?></td>
                    <td><?php echo $message['threadname']; ?></td>
                    <td><?php echo $message['content']; ?></td>
                    <td>
                        <span></span>
                    <a href="<?php echo BASE_URL.'admin/messages/update/'.$message['id']; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                        <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/messages/delete/'.$message['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>





    <!--Afficher les Messages de maniere correct pour la gestion de l'admin-->