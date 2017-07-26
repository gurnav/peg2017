<section class="information_panel">

    <div class="path">
        <p><i class="fa fa-home" aria-hidden="true"></i> > Forum Management</p>
    </div>

    <div class="four_icon">
        <div>
            <i class="fa fa-server" aria-hidden="true"></i>
            <h2><span><?php echo count($topics); ?></span>topics<span></span></h2>
        </div>
        <div>
            <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
            <h2><span><?php echo count($threads); ?></span>threads<span></span></h2>
        </div>
        <div>
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <h2><span><?php echo count($messages); ?></span>messages<span></span></h2>
        </div>
    </div>

        <div class="more_information">

        <div>
            <h2>Messages</h2>
            <table class="six_columns">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Thread</th>
                    <th>Content</th>

                    <!-- <th class="important_one">Status</th> -->
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($messages as $message): ?>
                    <tr>
                        <td><?php echo $message->id; ?></td>
                        <td><?php echo $message->username; ?></td>
                        <td><?php echo $message->threadname; ?></td>
                        <td><?php echo substr($message->content, 0, 30); ?>...</td>
                    </tr>
                    <?php
                        $i++;
                        if ($i === 10) break;
                    ?>
                <?php endforeach ?>
                </tbody>
            </table>

            <input type="button" value="VIEW MORE" class="view_more" onclick="window.location.href='<?php echo BASE_URL.'admin/messages'; ?>';" />
    </div>
            <div>
                <h2>Threads</h2>
            <table class="six_columns">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Topic</th>
                    <!--<th>Action</th>-->
                    <!-- <th class="important_one">Status</th>-->
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($threads as $thread): ?>
                    <tr>
                        <td><?php echo $thread->id; ?></td>
                        <td><?php echo $thread->title; ?></td>
                        <td><?php echo substr($thread->description,0,30); ?>...</td>
                        <td><?php echo $thread->username; ?></td>
                        <td><?php echo $thread->topicname; ?></td>
                    </tr>
                    <?php
                        $i++;
                        if ($i === 10) break;
                    ?>
                <?php endforeach ?>
                </tbody>
            </table>

                <input type="button" value="VIEW MORE" class="view_more" onclick="window.location.href='<?php echo BASE_URL.'admin/threads'; ?>';" />
            </div>

            <div>
                <h2>Topics</h2>
                <table class="six_columns">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>User</th>
                        <!-- <th class="important_one">Status</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;
                    foreach ($topics as $topic): ?>
                        <tr>
                            <td><?php echo $topic->id; ?></td>
                            <td><?php echo $topic->name; ?></td>
                            <td><?php echo substr($topic->description, 0, 30); ?>...</td>
                            <td><?php echo $topic->username; ?></td>
                        </tr>
                        <?php
                            $i++;
                            if ($i === 10) break;
                        ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
                <input type="button" value="VIEW MORE" class="view_more" onclick="window.location.href='<?php echo BASE_URL.'admin/topics'; ?>';" />
            </div>

</div>


</section>
