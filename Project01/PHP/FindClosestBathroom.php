<?php

require("config.php");

$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];


//starts new XML file and creates parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

//opens a connection to a mysql server
$conn = mysqli_connect($DBHOST, $DBUSERNAME, $DBPASSWORD);
if (!$conn) 
{
    die("Not Connected : " . mysql_error());
}

//set the active mysql database
$db_selected = mysqli_select_db($conn, $DBNAME);
if(!$db_selected)
{
    die("Can\'t use db : " . mysql_error());
}

//search the rows in the markers table
$query = sprintf("SELECT id, name, address, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $center_lng),
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $radius));
$result = mysqli_query($conn, $query);
$result = mysqli_query($conn, $query);

if(!$result)
{
    die("Invalid query : " . mysql_error());
}

header("Content-type: text/xml");

//Iterate through the rows and add XML node for each
while($row = @mysqli_fetch_assoc($result))
{
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id", $row['id']);
    $newNode->setAttribute("name", $row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();
?>