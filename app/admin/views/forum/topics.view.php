<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Topics</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Topics<a href="<?php echo BASE_URL.'admin/topics/add'; ?>"><button title="Create topic"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>User</th>
                <th class="important_one">Action</th>
               <!-- <th class="important_one">Status</th>-->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($topics as $topic): ?>
                <tr>
                    <td><?php echo $topic->id; ?></td>
                    <td><?php echo $topic->name; ?></td>
                    <td><?php echo substr($topic->description,0 ,30); ?>...</td>
                    <td><?php echo $topic->username; ?></td>
                    <td>
                    <span></span> <!--Bug affichage sans span dans le td-->
                    <a href="<?php echo BASE_URL.'admin/topics/update/'.$topic->id; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
                        <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/topics/delete/'.$topic->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
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
                echo "<a href='".BASE_URL."admin/topics/index/".($i / 10)."'>".($i / 10)."</a>";
            } while ($i < $count);
             ?>
           </div>
        <?php endif ?>

        <button class="view_more"><a href="<?php echo BASE_URL.'admin'; ?>">return</a></button>

    </div>

</section>
