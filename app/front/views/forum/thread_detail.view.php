<div>
<div class="body_item">
    <article class="article_solo" >
        <header>
            <h1><?php echo $threads->title ?></h1>
        </header>
        <table>
            <thead>
           <tr>
        <th> Number of messages :<?php echo $threads->nbmsg ?></th>
        <th>Description : <?php echo $threads->description ?></th>
               <th>Creation Date : <?php echo $threads->date_inserted ?></th>
        <th>Created by : <?php echo $threads->username ?></th>
           </tr>
            </thead>
        </table>
    </article>
    <div class="article_solo commentaries">
        <header>
            <h2>Comments:</h2>
        </header>
        <?php if(!isset($messages[0]->id)): ?>
            <p>No comment on this thread .</p>
       <?php elseif(isset($messages[0]->id)): ?>
        <?php for($i = 0; $i < sizeof($messages); $i ++): ?>

            <div class="comment">
                <div class="profil_area">
                    <h4><?php echo $messages[$i]->username ?></h4>
                    <img src="<?php echo ROUTE_DIR_USERS.$messages[$i]->img; ?>">
                </div>
                <div class="text_area">
                    <table>
                        <tr>
                    <td> <?php echo $messages[$i]->content ?></td>
                    <td align="right" width="20%"> Creation Date :<?php echo $messages[$i]->date_inserted ?></td>
                   <?php if (isset($_SESSION['user'])): ?>
                         <?php if($_SESSION['user']['username'] === $messages[$i]->username): ?>
                    <td align="right" width="3%"><button class="Delete" title="Delete" value="<?php echo BASE_URL.'forum/deleteMessage/'.$messages[$i]->id; ?>"><i class="fa fa-times" aria-hidden="true"></i></button></td>
                        <?php endif;?>
                    <?php endif;?>
                    </tr>
                    </table>
                </div>
            </div>
        <?php endfor; ?>
            <?php endif;?>
    </div>
</div>
<?php if (isset($_SESSION['user'])): ?>
    <div class="article_solo">
        <header>
            <h2>Write a message :</h2>
        </header>

        <form class="make_commentaries" method="POST" action="<?php echo BASE_URL.'forum/sendMessage'; ?>">
            <div class="super_editor">
                <textarea name="message" id="textarea" rows="10" cols="80"></textarea>
            </div>
            <div>
                <input type="hidden" name="thread_id" value="<?php echo $threads->id; ?>">
                <input class="send_commentaries" type="submit" value="Send it !">
            </div>
        </form>
    </div>
<?php else : ?>
    <div class="article_solo">
        <header>
            <h2>Write a message :</h2>
        </header>

        <p>You have to be connected to post a comment.</p>

    </div>
<?php endif; ?>
