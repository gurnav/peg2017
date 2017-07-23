
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
        <div class="triple_items">
            <?php foreach ($articles as $article): ?>
                    <article class="item">
                        <header>
                            <h2><?php echo $article->title; ?></h2>
                            <!-- <span></span> -->
                        </header>
                            <a href="<?php echo BASE_URL.'contents/'.$article->type.'/'.$article->id; ?>">
                            <img src="<?php echo ROUTE_DIR_CONTENTS.$article->thumbnails; ?>" alt="<?php echo $article->name; ?>">
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
                        <img src="<?php echo ROUTE_DIR_CONTENTS.$news->thumbnails; ?>" alt="<?php echo $news->name; ?>">
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
                        <img src="<?php echo ROUTE_DIR_CONTENTS.$page->thumbnails; ?>" alt="<?php echo $page->name; ?>">
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

</div>
</body>
