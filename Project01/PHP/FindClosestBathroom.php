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
    die("Not Connected : " . mysqli_error());
}

//set the active mysql database
$db_selected = mysqli_select_db($conn, $DBNAME);
if(!$db_selected)
{
    die("Can\'t use db : " . mysqli_error());
}

//search the rows in the markers table
$query = sprintf("SELECT id, name, address, lat, lng, description, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) 
                + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $center_lng),
    mysqli_real_escape_string($conn, $center_lat),
    mysqli_real_escape_string($conn, $radius));
$result = mysqli_query($conn, $query);
$result = mysqli_query($conn, $query);

if(!$result)
{
    die("Invalid query : " . mysqli_error($conn));
}

header("Content-type: text/xml");


if(mysqli_num_rows($result) > 0)
{
    while($row = @mysqli_fetch_assoc($result))
    {
        $node = $dom->createElement("marker");
        $newnode = $parnode->appendChild($node);
        $newnode->setAttribute("id", $row['id']);
        $newnode->setAttribute("name", $row['name']);
        $newnode->setAttribute("address", $row['address']);
        $newnode->setAttribute("lat", $row['lat']);
        $newnode->setAttribute("lng", $row['lng']);
        $newnode->setAttribute("description", $row['description']);
        $newnode->setAttribute("distance", $row['distance']);
    }
}
else
{
    echo"0 Results Found.";
}
//Iterate through the rows and add XML node for each


echo $dom->saveXML();
?>