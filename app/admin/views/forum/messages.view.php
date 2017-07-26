<section class="information_panel">

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
                <tr <?php if ($message->signaled) echo "class='comment_signal'"; ?> >
                    <td><?php echo $message->id; ?></td>
                    <td><?php echo $message->username; ?></td>
                    <td><?php echo $message->threadname; ?></td>
                    <td><?php echo substr($message->content,0,30); ?>...</td>
                    <td>
                        <span></span>
                    <a href="<?php echo BASE_URL.'admin/messages/update/'.$message->id; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                        <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/messages/delete/'.$message->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
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
                echo "<a href='".BASE_URL."admin/messages/index/".($i / 10)."'>".($i / 10)."</a>";
            } while ($i < $count);
             ?>
           </div>
        <?php endif ?>

        <button class="view_more"><a href="<?php echo BASE_URL.'admin'; ?>">return</a></button>

    </div>

</section>
