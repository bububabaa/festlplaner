<?php
require_once __DIR__.'/SimpleHTMLDOM/simple_html_dom.php';
//get html content from the site.
//$dom = file_get_html('https://www.imdb.com/title/tt4154756/reviews?ref_=tt_ql_3', false);
$dom = file_get_html('http://localhost/festlplaner/benutzerverwalten.php', false);

//collect all user’s reviews into an array
$answer = array();
if(!empty($dom)) {
$divClass = $title = "";$i = 0;
foreach($dom->find("table.table table-striped table-hover") as $divClass) {
//title
foreach($divClass->find("thead") as $title ) {
$answer[$i]['tr'] = $title->plaintext;
}
//ipl-ratings-bar
foreach($divClass->find("tbody") as $ipl_ratings_bar ) {
$answer[$i]['tr'] = trim($ipl_ratings_bar->plaintext);
}
/*foreach($divClass->find(".image_container") as $image ) {
$answer[$i]['img'] = trim($image->plaintext);
}*/
//content
/*foreach($divClass->find('div[class=text show-more__control]') as $desc) {
$text = html_entity_decode($desc->plaintext);
$text = preg_replace('/\&#39;/', "'", $text);
$answer[$i]['content'] = html_entity_decode($text);
}*/
$i++;
}
}
//print_r($answer); exit;

//function definition to convert array to xml
function array_to_xml($array, &$xml_user_info) {
foreach($array as $key => $value) {
if(is_array($value)) {
$subnode = $xml_user_info->addChild("Review$key");
foreach ($value as $k=>$v) {
$xml_user_info->addChild("$k",htmlspecialchars("$v"));
}
}else {
$xml_user_info->addChild("$key",htmlspecialchars("$value"));
}
}
return $xml_user_info->asXML();
}
//creating object of SimpleXMLElement
$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
//function call to convert array to xml and return whole xml content with tag
$xmlContent = array_to_xml($answer,$xml_user_info);

// Create a xml file
$my_file = 'Benutzerliste.xml';
$handle = fopen($my_file, 'w') or die('Cannot open file: '.$my_file);
//success and error message based on xml creation
if(fwrite($handle, $xmlContent)) {
echo 'XML file have been generated successfully.';
}
else{
echo 'XML file generation error.';
}
?>

<!DCOCTYPE html>
<html>
    <head>
        <title>Welcome to HTML</title>
    </head>
    <body>
        <h1>SIMPLE HTML CODE</h1>
        <p>HTML stands for Hyper Text Markup Language</p>
    </body>
</html>
