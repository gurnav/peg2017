<section class="information_panel">

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
                <th>Action<th></th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category->id; ?></td>
                    <td><?php echo $category->name; ?></td>
                    <td><?php echo $category->description; ?></td>
                    <td><?php echo $category->date_inserted; ?></td>
                    <td><?php echo $category->username; ?></td>

                    <td class="action_special"><a href="<?php echo BASE_URL.'admin/categories/update/'.$category->id; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a></td>

                    <td class="action_special"><button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/categories/delete/'.$category->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

    <?php if ($count > 10): ?>
        <?php $i = 0;
        do {
            $i += 10;
            echo "<div><a href='".BASE_URL."admin/categories/index/".($i / 10)."'>".($i / 10)."</a></div>";
        } while ($i < $count);
         ?>
    <?php endif ?>

</section>
