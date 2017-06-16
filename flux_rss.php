<?php

$xml_file = new DOMDocument("1.0");

function &init_news_rss(&$xml_file)
{
    $root = $xml_file->create_element("rss"); // création de l'élément
    $root->set_attribute("version", "2.0"); // on lui ajoute un attribut
    $root = $xml_file->append_child($root); // on l'insère dans le nœud parent (ici root qui est "rss")

    $channel = $xml_file->create_element("channel");
    $channel = $root->append_child($channel);

    $desc = $xml_file->create_element("description");
    $desc = $channel->append_child($desc);
    $text_desc = $xml_file->create_text_node("Partage de connaissances en tous genres"); // on insère du texte entre les balises <description></description>
    $text_desc = $desc->append_child($text_desc);

    $link = $xml_file->create_element("link");
    $link = $channel->append_child($link);
    $text_link = $xml_file->create_text_node("esgiGeographik");
    $text_link = $link->append_child($text_link);

    $title = $xml_file->create_element("title");
    $title = $channel->append_child($title);
    $text_title = $xml_file->create_text_node("EsgiGeographik");
    $text_title = $title->append_child($text_title);

    return $channel;
}

function add_news_node(&$parent, $root, $id, $pseudo, $titre, $contenu, $date)
{
    $item = $parent->create_element("item");
    $item = $root->append_child($item);

    $title = $parent->create_element("title");
    $title = $item->append_child($title);
    $text_title = $parent->create_text_node($titre);
    $text_title = $title->append_child($text_title);

    $link = $parent->create_element("link");
    $link = $item->append_child($link);
    $text_link = $parent->create_text_node("esgiGeographik/rss_news".$id.".html");
    $text_link = $link->append_child($text_link);

    $desc = $parent->create_element("description");
    $desc = $item->append_child($desc);
    $text_desc = $parent->create_text_node($contenu);
    $text_desc = $desc->append_child($text_desc);

    $com = $parent->create_element("comments");
    $com = $item->append_child($com);
    $text_com = $parent->create_text_node("esgiGeographik/news-11-".$id.".html");
    $text_com = $com->append_child($text_com);

    $author = $parent->create_element("author");
    $author = $item->append_child($author);
    $text_author = $parent->create_text_node($pseudo);
    $text_author = $author->append_child($text_author);

    $pubdate = $parent->create_element("pubDate");
    $pubdate = $item->append_child($pubdate);
    $text_date = $parent->create_text_node($date);
    $text_date = $pubdate->append_child($text_date);

    $guid = $parent->create_element("guid");
    $guid = $item->append_child($guid);
    $text_guid = $parent->create_text_node("esgiGeographik/rss_news".$id.".html");
    $text_guid = $guid->append_child($text_guid);

    $src = $parent->create_element("source");
    $src = $item->append_child($src);
    $text_src = $parent->create_text_node("esgiGeographik");
    $text_src = $src->append_child($text_src);
}

function rebuild_rss()
{
    // on se connecte à la BDD
    try {
        $conn = new PDO(DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PWD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    // on récupère les news
    $nws = "SELECT id, title, content, status, date_inserted from ".DB_PREFIX."contents";
    $query = $conn->query($nws);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    // on crée le fichier XML
    $xml_file = new DOMDocument("1.0");

    // on initialise le fichier XML pour le flux RSS
    $channel = init_news_rss($xml_file);

    // on ajoute chaque news au fichier RSS
    foreach ($row as $kk => $vv) {
        add_news_node($xml_file, $channel, $vv["id"], $vv["titre_article"], $vv["contenu"], $vv["statut"], $vv["date_parution"]);
    }
    if ($xml_file->save("news_FR_flux.xml")) {
        echo "Génération réussie...";
        header("Location: " . "news_FR_flux.xml");
    } else {
        echo "Génération échouée.";
    }

    // on écrit le fichier
    $xml_file->dump_file("news_FR_flux.xml");
}
?>
