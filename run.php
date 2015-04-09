<?php
//  Add the site classes first.
require_once 'Sites.class.php';
require_once 'Site.class.php';

// Add the urls
include 'urls.php';


$sites = new Sites();
$sites->addSites($urls);
