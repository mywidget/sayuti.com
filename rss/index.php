<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
// error_reporting(0);
// header('Content-Type: text/html; charset=UTF-8');
include "../class/conn_db.php";
include "../class/web_function.php";
include "../class/referer.php";

header('Content-Type: text/xml; charset=utf-8', true); //set document header content type to be XML
$rss = new SimpleXMLElement('<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
$rss->addAttribute('version', '2.0');

$channel = $rss->addChild('channel'); //add channel node

$atom = $rss->addChild('atom:atom:link'); //add atom node
$atom->addAttribute('href', $host); //add atom node attribute
$atom->addAttribute('rel', 'self');
$atom->addAttribute('type', 'application/rss+xml');


$title = $rss->addChild('title','Sayuti.com Feed'); //title of the feed
$description = $rss->addChild('description','Percetakan serang'); //feed description
$link = $rss->addChild('link',$host); //feed site
$language = $rss->addChild('language','id-id'); //language

		
//Create RFC822 Date format to comply with RFC822
$date_f = date("D, d M Y H:i:s T", time());
$build_date = gmdate(DATE_RFC2822, strtotime($date_f)); 
$lastBuildDate = $rss->addChild('lastBuildDate',$date_f); //feed last build date

$generator = $rss->addChild('generator','PHP Simple XML'); //add generator node


$results = $db->query("SELECT * FROM posting WHERE tanggal < NOW() AND publish='Y' order by tanggal DESC LIMIT 15");

if($results){ //we have records 
	while($row = $results->fetch_object()) //loop through each row
	{
		$url = $host.'category/'.$row->judul_seo;
		$item = $rss->addChild('item'); //add item node
		$title = $item->addChild('title', $row->judul); //add title node under item
		$link = $item->addChild('guid', $url);
		//add link node under item
		$guid = $item->addChild('guid', $url); //add guid node under item
		$guid->addAttribute('isPermaLink', 'false'); //add guid node attribute
		$description = $item->addChild('description', htmlentities(kata($row->postingan,200)));
		$date_rfc = gmdate(DATE_RFC2822, strtotime($row->tanggal));
		$item = $item->addChild('pubDate', $date_rfc); //add pubDate node
	}
}

echo $rss->asXML(); //output XML
?>