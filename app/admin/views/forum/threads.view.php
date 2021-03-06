<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Threads</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Threads<a href="<?php echo BASE_URL.'admin/threads/add'; ?>"><button title="Create thread"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>User</th>
                <th>Topic</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($threads as $thread): ?>
                <tr>
                    <td><?php echo $thread->id; ?></td>
                    <td><?php echo $thread->title; ?></td>
                    <td><?php echo substr($thread->description, 0, 30); ?>...</td>
                    <td><?php echo $thread->username; ?></td>
                    <td><?php echo $thread->topicname; ?></td>
                    <td>
                        <span></span>
                        <a href="<?php echo BASE_URL.'admin/threads/update/'.$thread->id; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                        <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/threads/delete/'.$thread->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <?php if ($count > 10): ?>
            <div class="pagination">
            <?php $i = 0;
            do {
                $i += 10;
                echo "<a href='".BASE_URL."admin/threads/index/".($i / 10)."'>".($i / 10)."</a>";
            } while ($i < $count);
             ?>
           </div>
        <?php endif ?>

        <button class="view_more"><a href="<?php echo BASE_URL.'admin'; ?>">return</a></button>

    </div>

</section>
