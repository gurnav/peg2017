<body>
<div class="body_item">
    <article class="presentation">
        <h1 class="page_title">The Forum</h1>
        <p class="description">This is our forum, please enjoy !</p>
    </article>
    <div class="list_subject">
        <h2>Detail of <?php echo $topics->name ?> topic </h2>
        <table>
            <thead>
            <tr>
                <th><?php echo $topics->name ?></th>
                <th>Description :<?php echo $topics->description ?></th>
                <th>Number of Threads :<?php echo $topics->nbthreads ?></th>
                <th>Creation Date : <?php echo $topics->date_inserted ?> </th>
                <th><div class="profil_area">
                        <h4>Created by <?php echo $topics->username ?></h4>
                    </div>
                </th>
            </tr>
            </tr>
            </thead>
            <tbody>
                <?php for($j = 0; $j < sizeof($threads); $j ++): ?>
                <tr>
                <td><a href="<?php echo BASE_URL.'forum/thread_detail/'.$threads[$j]->id; ?>"><?php echo $threads[$j]->title ?></a></td>
                <td><?php echo $threads[$j]->description ?></td>
                    <td>Number of messages :<?php echo $threads[$j]->nbmsg ?></td>
                <td>Creation Date : <?php echo $threads[$j]->date_inserted ?> </td>
                    <td><div class="profil_area">
                            <h4>Created by <?php echo $threads[$j]->username ?></h4>
                        </div>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="article_solo">
                <header>
                    <h2>Write a Thread :</h2>
                </header>

                <form class="make_commentaries" method="POST" action="<?php echo BASE_URL.'forum/sendThread'; ?>">
                    <div class="super_editor">
                        <label>
                            The title of your Thread :
                            <input class="input_forum" type="text" name="title" placeholder="Write your title here" required="required">
                        </label>
                        <div>
                            <h3>The description of your Thread :</h3>
                        <textarea name="description" id="textarea" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="topic_id" value="<?php echo $topics->id; ?>">
                        <input class="send_commentaries" type="submit" value="Send it !">
                    </div>
                </form>
            </div>
        <?php else : ?>
            <div class="article_solo">
                <header>
                    <h2>Write a Thread :</h2>
                </header>

                <p>You have to be connected to post a Thread.</p>

            </div>
        <?php endif; ?>
        <div class="back_link">
            <a href="<?php echo BASE_URL.'forum'; ?>"><< Back to the forum</a>
        </div>
    </div>
</div>
