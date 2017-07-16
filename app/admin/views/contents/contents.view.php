<section class="information_panel">

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
                <!-- <th>Content</th> -->
                <th>Date Publication</th>
                <th>Username</th>
                <th class="important_one">Verification</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contents as $content): ?>
                <tr>
                    <td><?php echo $content['id']; ?></td>
                    <td><?php echo $content['title']; ?></td>
                    <td><?php echo $content['type']; ?></td>
                    <!-- <td><?php echo substr($content['content'], 0, 128)." ..."; ?></td> -->
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

                    echo "<td><span class=".$status.">".ucfirst($status)."</span>";
                    ?>
                    <a href="<?php echo BASE_URL.'admin/contents/update/'.$content['id']; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                    <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/contents/delete/'.$content['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>

<?php
    /*require('flux_rss.php');
    rebuild_rss();*/
?>
