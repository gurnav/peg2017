
<body class="page-landing is-loading">
<?php if(isset($msg)) echo "<script>alert('".$msg."');</script>" ?>
<div id="wrapper">

    <div id="banner">
        <div class="inner">
            <div>
                <h1>ESGI-Geographic</h1>
            </div>
        </div>
    </div>

    <section id="items">
        <div class="triple_items">
            <?php foreach ($articles as $article): ?>
                    <article class="item">
                        <header>
                            <h2><?php echo $article->title; ?></h2>
                            <!-- <span></span> -->
                        </header>
                            <a href="<?php echo BASE_URL.'contents/'.$article->type.'/'.$article->id; ?>">
                            <img src="<?php echo UPLOADS_DIR_CONTENTS.$article->thumbnail; ?>">
                        </a>
                    </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="items">
        <div class="triple_items">
            <?php foreach ($news as $news): ?>
                <article class="item">
                    <header>
                        <h2><?php echo $news->title; ?></h2>
                        <!-- <span></span> -->
                    </header>
                    <a href="<?php echo BASE_URL.'contents/'.$news->type.'/'.$news->id; ?>">
                        <img src="<?php echo UPLOADS_DIR_CONTENTS.$news->thumbnail; ?>">
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="items">
        <div class="triple_items">
            <?php foreach ($pages as $page): ?>
                <article class="item">
                    <header>
                        <h2><?php echo $page->title; ?></h2>
                        <!-- <span></span> -->
                    </header>
                    <a href="<?php echo BASE_URL.'contents/'.$page->type.'/'.$page->id; ?>">
                        <img src="<?php echo UPLOADS_DIR_CONTENTS.$page->thumbnail; ?>">
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

</div>
</body>
