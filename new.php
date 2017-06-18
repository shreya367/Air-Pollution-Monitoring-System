<?php
//include("C:\xampp\htdocs\phpfiles\index.php");
require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("gases");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
/*$sql ="UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=1";
$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=2";
$sql= "UPDATE gases SET CO=RAND()*100,NO=RAND()*100,NO2=RAND()*100,O3=RAND()*100,FineParticles=RAND()*100,CourseParticles=RAND()*100 WHERE id=3";
*/

/*$query = "SELECT * FROM gases WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("gas");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("CO",$row['CO']);
  $newnode->setAttribute("NO", $row['NO']);
  $newnode->setAttribute("NO2", $row['NO2']);
  $newnode->setAttribute("O3", $row['O3']);
  $newnode->setAttribute("FineParticles", $row['FineParticles']);
  $newnode->setAttribute("CourseParticles", $row['CourseParticles']);
}
echo $dom->saveXML();*/
function toXML(){
	$data_txt=null;
    $myFile = "myxml.xml";
    $fh = fopen($myFile, 'w') or die("can't open file");
    $data_txt .= '<?xml version="1.0" encoding="utf-8"?>';
    $data_txt .= '<gases>';

    $query = mysql_query("SELECT * FROM gases");
    while($values_query = mysql_fetch_assoc($query))
    {
        $data_txt .= '<gas>';
        $data_txt .= '<CO>' .$values_query['CO']. '</CO>';
        $data_txt .= '<NO>' .$values_query['NO']. '</NO>';
		$data_txt .= '<NO2>' .$values_query['NO2']. '</NO2>';
		$data_txt .= '<O3>' .$values_query['O3']. '</O3>';
		$data_txt .= '<FineParticles>' .$values_query['FineParticles']. '</FineParticles>';
		$data_txt .= '<CourseParticles>' .$values_query['CourseParticles']. '</CourseParticles>';
		$data_txt .= '<lat>' .$values_query['lat']. '</lat>';
		$data_txt .= '<lng>' .$values_query['lng']. '</lng>';
		$data_txt .= '<type>' .$values_query['type']. '</type>';
        $data_txt .= '</gas>';
    }
    $data_txt .= '</gases>';
    fwrite($fh, $data_txt);
    fclose($fh);
}
?>