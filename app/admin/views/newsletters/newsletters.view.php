<section class="information_panel">



    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Newsletters</p>
    </div>

    <div class="only_one">
        <table class="six_columns">
            <caption>Newsletters<a href="<?php echo BASE_URL.'admin/newsletters/add'; ?>"><button title="Subscribe to newsletter"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($subscribes as $subscribe): ?>
                <tr>
                    <td><?php echo $subscribe['id']; ?></td>
                    <td><?php echo $subscribe['email']; ?></td>
                    <td>
                        <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/newsletters/delete/'.$subscribe['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <button class="view_more">view more</button>

    </div>

</section>