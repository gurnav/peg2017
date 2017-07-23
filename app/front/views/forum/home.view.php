<body>
<div class="body_item">
    <article class="presentation">
        <h1 class="page_title">The Forum</h1>
        <p class="description">This is our forum, please enjoy !</p>
    </article>
    <div class="list_subject">
        <h2>List of all Topics and their recent Threads</h2>
        <?php for($i = 0; $i < sizeof($topics); $i++): ?>
        <table>
            <thead>
            <tr>
                <th><a href="<?php echo BASE_URL.'forum/topic_detail/'.$topics[$i]->id; ?>"> <?php echo $topics[$i]->name ?></a></th>
                <th>Description :<?php echo $topics[$i]->description ?></th>
                <th>Number of Threads :<?php echo $topics[$i]->nbthreads?></th>
                <th>Creation Date : <?php echo $topics[$i]->date_inserted ?></th>
                <th><div class="profil_area">
                    <h4>Created by <?php echo $topics[$i]->username ?></h4>
                        <img src="<?php echo ROUTE_DIR_USERS.$topics[$i]->img; ?>">
                        <!--<img src="img/test.jpg">-->
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php  $cpt=0;
            for($j = 0; $j < sizeof($threads); $j ++): ?>
            <tr>
                <?php if($topics[$i]->id == $threads[$j]->topics_id && $cpt < 3): ?>
                <td><a href="<?php echo BASE_URL.'forum/thread_detail/'.$threads[$j]->id; ?>"><?php echo $threads[$j]->title ?></a></td>
                <td><?php echo $threads[$j]->description ?></td>
                    <td>Number of Messages :<?php echo $threads[$j]->nbmsg?></td>
                    <td>Creation Date : <?php echo $threads[$j]->date_inserted ?> </td>
                    <td>Created by <?php echo $threads[$j]->username ?> </td>
                <?php
                    $cpt++;
                endif; ?>
            </tr>
            <?php endfor; ?>
        </table>
        <?php endfor; ?>
    </div>
</div>
</body>
