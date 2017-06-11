<header>
  <div class="top_line">
    <p>Welcome <span><?php echo $_SESSION['admin']['username']; ?></span></p>
    <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><button>Logout</button></a>
  </div>
  <div id="burger_menu">≡</div>
  <nav id="nav_bar" class="nav_bar">
    <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/comments'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Comments</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
    <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
  </nav>
</header>

<div id="loader"></div>

<section class="information_panel">

  <div class="path">
    <p><i class="fa fa-home" aria-hidden="true"></i> > DashBoard</p>
  </div>

  <div class="four_icon">
    <div>
      <i class="fa fa-camera" aria-hidden="true"></i>
      <h2><span><?php echo count($multimedias); ?></span>medias<span></span></h2>
    </div>
    <div>
      <i class="fa fa-upload" aria-hidden="true"></i>
      <h2><span><?php echo count($contents); ?></span>contents<span></span></h2>
    </div>
    <div>
      <i class="fa fa-download" aria-hidden="true"></i>
      <h2><span><?php echo count($comments); ?></span>comments<span></span></h2>
    </div>
    <div>
      <i class="fa fa-user-plus" aria-hidden="true"></i>
      <h2><span><?php echo count($users); ?></span>users<span></span></h2>
    </div>
  </div>

  <div class="stats_graph">
    <h2>Activity Statistics</h2>

  </div>

  <div class="more_information">
      <div>
          <table class="six_columns">
              <caption>Latest Articles</caption>
              <thead>
              <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>type</th>
                  <th>User Id</th>
                  <th>Status</th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($contents as $content): ?>
                  <tr>
                      <td><?php echo $content['id']; ?></td>
                      <td><?php echo $content['title']; ?></td>
                      <td><?php echo $content['type']; ?></td>
                      <td><?php echo $content['users_id']; ?></td>
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

                      echo "<td><button class=".$status.">".ucfirst($status)."</button></td>";
                      ?>
                  </tr>
              <?php endforeach ?>
              </tbody>
          </table>

          <button class="view_more">view more</button>

      </div>

    <div>
      <table class="six_columns">
        <caption>Latest Users</caption>
        <thead>
          <tr>
            <th>#</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['firstname']; ?></td>
              <td><?php echo $user['lastname']; ?></td>
              <td><?php echo $user['username']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <?php
                  if($user['status'] == -1) {
                    $status = 'rejected';
                  }

                  if($user['status'] == 0) {
                    $status = 'pending';
                  }

                  if($user['status'] == 1) {
                    $status = 'done';
                  }

                  echo "<td><button class=".$status.">".ucfirst($status)."</button></td>";
               ?>
            </tr>
        <?php endforeach ?>
        </tbody>
      </table>

      <button class="view_more">view more</button>

    </div>
  </div>

</section>
