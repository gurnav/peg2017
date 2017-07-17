<?php

namespace App\Front\Controllers;

use Core\Controllers\Controller;
use App\Front\Models\Contents;
use Core\Util\Helpers;

class RssController extends Controller
{
    public function indexAction()
    {
        header("Content-type: text/xml");

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0">';
        $xml .= '<channel>';
        $xml .= ' <title>RSS Stream of ESGI Geographic</title>';
        $xml .= ' <link>'.BASE_URL.'</link>';
        $xml .= ' <description>Here you can see the latest contents of our site</description>';
        // $xml .= ' <image>';
        // $xml .= '   <title>Titre de l\'image</title>';
        // $xml .= '   <url>http://www.craym.eu/logo.png</url> ';
        // $xml .= '   <link>http:///www.craym.eu/tutoriels.html</link> ';
        // $xml .= '   <description>Toute nos tutoriels sur Craym.eu !</description>';
        // $xml .= '   <width>80</width>';
        // $xml .= '   <height>80</width>';
        // $xml .= ' </image>';
        $xml .= ' <language>fr</language>';
        $xml .= ' <copyright>esgi-geographic.com/cgu</copyright>';
        // $xml .= ' <managingEditor></managingEditor>';
        // $xml .= ' <generator>PHP/MySQL</generator>';
        // $xml .= ' <docs></docs>';

        $xml .= ' <category>Articles</category>';

        $articles = Contents::getAllByType('article', true);
        foreach ($articles as $article)
        {
            $xml .= '<item>';
            $xml .= '<title>'.$article['title'].'</title>';
            $xml .= '<link>'.BASE_URL.'contents/article/'.$article['id'].'</link>';
            $xml .= '<guid isPermaLink="true">'.BASE_URL.'contents/article/'.$article['id'].'</guid>';
            $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($article['date_inserted']))).'</pubDate>';
            $xml .= '<description>'.strip_tags(substr($article['content'], 0, 128)).'</description>';
            $xml .= '</item>';
        }

        $xml .= ' <category>News</category>';

        $news = Contents::getAllByType('news', true);
        foreach ($news as $n)
        {
            $xml .= '<item>';
            $xml .= '<title>'.$n['title'].'</title>';
            $xml .= '<link>'.BASE_URL.'contents/article/'.$n['id'].'</link>';
            $xml .= '<guid isPermaLink="true">'.BASE_URL.'contents/article/'.$n['id'].'</guid>';
            $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($n['date_inserted']))).'</pubDate>';
            $xml .= '<description>'.strip_tags(substr($n['content'], 0, 128)).'</description>';
            $xml .= '</item>';
        }

        $xml .= '</channel>';
        $xml .= '</rss>';

        echo $xml;

    }
}
