  <header>
    <div class="top_line">
      <p>Welcome <span><?php echo $_SESSION['admin']['username']; ?></span></p>
      <a href="<?php echo BASE_URL.'admin/login/logout'; ?>"><button>log<i class="fa fa-power-off" aria-hidden="true"></i>ut</button></a>
    </div>
    <div id="burger_menu">≡</div>
    <nav id="nav_bar" class="nav_bar">
      <li><a href="<?php echo BASE_URL.'admin'; ?>"><i class="fa fa-cube" aria-hidden="true"></i><span>Home</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/users'; ?>"><i class="fa fa-users" aria-hidden="true"></i><span>Users</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/medias'; ?>"><i class="fa fa-usb" aria-hidden="true"></i><span>Medias</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/contents'; ?>"><i class="fa fa-life-ring" aria-hidden="true"></i><span>Pages &amp; Articles</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/commentaries'; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Commentaries</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/categories'; ?>"><i class="fa fa-files-o" aria-hidden="true"></i><span>Categories</span></a></li>
      <li><a href="<?php echo BASE_URL.'admin/stats'; ?>"><i class="fa fa-line-chart" aria-hidden="true"></i><span>Statistics</span></a></li>
    </nav>
  </header>

<section class="information_panel">

		<div id="loader"></div>

		<div class="path">
			<p><i class="fa fa-home" aria-hidden="true"></i> > Users</p>
		</div>

		<div class="only_one">
			<table class="six_columns">
				<caption>Users<a href="<?php echo BASE_URL.'admin/users/add'; ?>"><button title="Create user"><i class="fa fa-plus-circle" aria-hidden="true"></i></button></a></caption>
				<thead>
					<tr>
            <th>#</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>Email</th>
						<th class="important_one">Status</th>
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

                  echo "<td><span class=".$status.">".ucfirst($status)."</span>";
               ?>
               <a href="<?php echo BASE_URL.'admin/users/update/'.$user['id']; ?>"><button title="Modify"><i class="fa fa-cogs" aria-hidden="true"></i></button></a>
               <button class="Delete" title="Delete" value="<?php echo BASE_URL.'admin/users/delete/'.$user['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></button>
             </td>
            </tr>
        <?php endforeach ?>
				</tbody>
			</table>

			<button class="view_more">view more</button>

		</div>

	</section>
