<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Comments</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Comments <!--<a href="<?php echo BASE_URL.'admin/comments/add'; ?>"><button title="Create comment"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a> --> </caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Comment</th>
                <th>Date Inserted</th>
                <th>Contents Name</th>
                <th>Username</th>
                <th>Action<th></th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($comments as $comment): ?>
                    <td><?php echo $comment->id; ?></td>
                    <td><?php echo $comment->content; ?></td>
                    <td><?php echo $comment->date_inserted; ?></td>
                    <td><?php echo $comment->contentname; ?></td>
                    <td><?php echo $comment->username; ?></td>

                    <td class="action_special"><a href="<?php echo BASE_URL.'admin/comments/update/'.$comment->id; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a></td>
                    <td class="action_special"><a href="<?php echo BASE_URL.'admin/comments/delete/'.$comment->id; ?>"><button class="Delete" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></button></a></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>
</section>
