<?php

//On déclare la fonction Php :
function update_fluxRSS() {

    /*  Nous allons générer notre fichier XML d'un seul coup. Pour cela, nous allons stocker tout notre
      fichier dans une variable php : $xml.
      On commence par déclarer le fichier XML puis la version du flux RSS 2.0.
      Puis, on ajoute les éléments d'information sur le channel. Notez que nous avons volontairement
      omit quelques balises :
    */

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<rss version="2.0">';
    $xml .= '<channel>';
    $xml .= ' <title>Voici mon premier flux RSS !</title>';
    $xml .= ' <link>http://www.craym.eu</link>';
    $xml .= ' <description>Voici le flux RSS de mon site ! Suivez le pour avoir les dernières news !</description>';
    $xml .= ' <image>';
    $xml .= '   <title>Titre de l\'image</title>';
    $xml .= '   <url>http://www.esgi-geographic.com</url> ';
    $xml .= '   <link>http:///www.esgi-geographic.com/index.html</link> ';
    $xml .= '   <description>Toutes nos actus sur Esgi-Geographic !</description>';
    $xml .= '   <width>80</width>';
    $xml .= '   <height>80</width>';
    $xml .= ' </image>';
    $xml .= ' <language>fr</language>';
    $xml .= ' <copyright>Craym.eu</copyright>';
    $xml .= ' <managingEditor>rss@esgi-geographic.eu</managingEditor>';
    $xml .= ' <category>Actus</category>';
    $xml .= ' <generator>PHP/MySQL</generator>';
    $xml .= ' <docs>http://www.rssboard.org</docs>';



    /*  Maintenant, nous allons nous connecter à notre base de données afin d'aller chercher les
      items à insérer dans le flux RSS.
    */

//on lit les 25 premiers éléments à partir du dernier ajouté dans la base de données
    $index_selection = 0;
    $limitation = 25;

//On se connecte à notre base de données (pensez à mettre les bons logins)
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=flux_rss', 'nom_utilisateur', 'mot_de_passe');
    }
    catch(Exception $e) {die('Erreur : '.$e->getMessage());}

//On prépare la requête et on exécute celle-ci pour obtenir les informations souhaitées :
    $reponse = $bdd->prepare('SELECT * FROM flux_rss ORDER BY pubDate DESC LIMIT :index_selection, :limitation') or die(print_r($bdd->errorInfo()));
    $reponse->bindParam('index_selection', $index_selection, PDO::PARAM_INT);
    $reponse->bindParam('limitation', $limitation, PDO::PARAM_INT);
    $reponse->execute();

//Une fois les informations récupérées, on ajoute un à un les items à notre fichier
    while ($donnees = $reponse->fetch())
    {
        $xml .= '<item>';
        $xml .= '<title>'.stripcslashes($donnees['title']).'</title>';
        $xml .= '<link>'.$donnees['link'].'</link>';
        $xml .= '<guid isPermaLink="true">'.$donnees['link'].'</guid>';
        $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($donnees['pubDate']))).'</pubDate>';
        $xml .= '<description>'.stripcslashes($donnees['description']).'</description>';
        $xml .= '</item>';
    }

//Puis on termine la requête
    $reponse->closeCursor();

//Et on ferme le channel et le flux RSS.
    $xml .= '</channel>';
    $xml .= '</rss>';

    /*  Tout notre fichier RSS est maintenant contenu dans la variable $xml.
      Nous allons maintenant l'écrire dans notre fichier XML et ainsi mettre à jour notre flux.
      Pour cela, nous allons utiliser les fonctions de php File pour écrire dans le fichier.

      Notez que l'adresse URL du fichier doit être relative obligatoirement !
    */

//On ouvre le fichier en mode écriture
    $fp = fopen("flux_rss.xml", 'w+');

//On écrit notre flux RSS
    fputs($fp, $xml);

//Puis on referme le fichier
    fclose($fp);

} //Fermeture de la fonction
?>