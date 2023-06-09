<?php
require_once("/Users/kamillukasiuk/Desktop/webDev/netflix-clone/includes/config.php");
require_once("/Users/kamillukasiuk/Desktop/webDev/netflix-clone/includes/classes/SearchResultsProvider.php");
require_once("/Users/kamillukasiuk/Desktop/webDev/netflix-clone/includes/classes/EntityProvider.php");
require_once("/Users/kamillukasiuk/Desktop/webDev/netflix-clone/includes/classes/Entity.php");
require_once("/Users/kamillukasiuk/Desktop/webDev/netflix-clone/includes/classes/PreviewProvider.php");

if (isset($_POST["term"]) && isset($_POST["username"])) {
    $term = strip_tags($_POST["term"]);
    $username = strip_tags($_POST["username"]);

    $srp = new SearchResultsProvider($con, $username);
    echo $srp->getResults($term);
} else {
    echo "No term or username passed into file";
}
