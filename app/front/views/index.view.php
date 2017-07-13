
<body class="page-landing is-loading">
<?php if(isset($msg)) echo "<script>alert('".$msg."');</script>" ?>
<div id="wrapper">

    <div id="banner">
        <div class="inner">
            <ul class="actions big">
                <li><a href="#" class="button big scrolly">Start</a></li>
            </ul>
        </div>
    </div>
    <section id="items">
        <?php for($i = 0; $i < sizeof($contents); $i += 3): ?>
            <div class="triple_items">
                <?php for($j = $i; $j < $i + 3; $j += 1): ?>
                    <?php if(isset($contents[$j])): ?>
                        <article class="item">
                            <header>
                                <h2><?php echo $contents[$j]['title']; ?></h2>
                                <!-- <span></span> -->
                            </header>
                            <a href="<?php echo BASE_URL.'contents/'.$contents[$i]['type'].'/'.$contents[$i]['id']; ?>">
                                <img src="<?php echo UPLOADS_DIR_CONTENTS.$contents[$i]['thumbnail']; ?>">
                            </a>
                        </article>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>

        <!--<article class="item">
            <header>
                <h2>Article 2</h2>
                <span class="category">CATEGORIE</span>
            </header>
            <a href="#" class="image lazy" style="background-color: #a3afb1;">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'photo2.jpg' ?>" />
            </a>
        </article>
        <article class="item">
            <header>
                <h2>Article 3</h2>
                <span class="category">CATEGORIE</span>
            </header>
            <a href="#" class="image lazy" style="background-color: #e6e1e0;">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'photo3.jpg' ?>" />
            </a>
        </article>-->


    </section>


    <!-- The Modal -->
    <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'"
        class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
                <img src="<?php echo PATH_RELATIVE.'public'.DS.'assets'.DS.'images'.DS.'avatar.png' ?>" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit">Login</button>
                <input type="checkbox" checked="checked"> Remember me
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
</body>
