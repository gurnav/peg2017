
<body class="page-landing is-loading">
<?php if(isset($msg)) echo "<script>alert('".$msg."');</script>" ?>
<div id="wrapper">

    <div id="banner">
        <div class="inner"></div>
    </div>

    <?php if (isset($articles) && !empty($articles)): ?>
    <section id="items">
        <div class="triple_items">

            <div class="title">
                <p class="content_title"><i class="fa fa-server" aria-hidden="true"></i> Articles</p>
            </div>
            <div>
            <?php foreach ($articles as $article): ?>
                    <article class="item">
                        <header>
                            <h2><?php echo $article->title; ?> | <?php echo $article->category_name; ?></h2>
                        </header>
                            <a href="<?php echo BASE_URL.'contents/'.$article->type.'/'.$article->id; ?>">
                            <img src="<?php echo ROUTE_DIR_CONTENTS.$article->thumbnails; ?>" alt="<?php echo $article->name; ?>">
                        </a>
                    </article>
            <?php endforeach; ?>
            </div>
            <div class="linkto">
                <p class="content_link"><a href="<?php echo BASE_URL.'contents/all_articles' ?>">View  More</a></p>
            </div>
        </div>
    </section>
    <?php endif ?>

    <?php if (isset($news) && !empty($news)): ?>
    <section id="items">
        <div class="triple_items">
            <div class="title">
                <p class="content_title"><i class="fa fa-newspaper-o" aria-hidden="true"></i> News</p>
            </div>
            <div>
                <?php foreach ($news as $news): ?>
                    <article class="item">
                        <header>
                            <h2><?php echo $news->title; ?> | <?php echo $news->category_name; ?></h2>
                        </header>
                        <a href="<?php echo BASE_URL.'contents/'.$news->type.'/'.$news->id; ?>">
                            <img src="<?php echo ROUTE_DIR_CONTENTS.$news->thumbnails; ?>" alt="<?php echo $news->name; ?>">
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="linkto">
                <p class="content_link"><a href="<?php echo BASE_URL.'contents/all_news' ?>">View  More</a></p>
            </div>
        </div>
    </section>
    <?php endif ?>

    <?php if (isset($pages) && !empty($pages)): ?>
    <section id="items">
        <div class="triple_items">
            <div class="title">
                <p class="content_title"><i class="fa fa-tags" aria-hidden="true"></i> Pages</p>
            </div>
            <div>
                <?php foreach ($pages as $page): ?>
                    <article class="item">
                        <header>
                            <h2><?php echo $page->title; ?> | <?php echo $page->category_name; ?></h2>
                        </header>
                        <a href="<?php echo BASE_URL.'contents/'.$page->type.'/'.$page->id; ?>">
                            <img src="<?php echo ROUTE_DIR_CONTENTS.$page->thumbnails; ?>" alt="<?php echo $page->name; ?>">
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="linkto">
                <p class="content_link"><a href="<?php echo BASE_URL.'contents/all_pages' ?>">View  More</a></p>
            </div>
        </div>
    </section>
    <?php endif ?>

</div>
</body>
