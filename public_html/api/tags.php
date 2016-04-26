<?php

// Connect to database
$dbc = new mysqli('localhost', 'root', '', 'schlock');

$sql = "SELECT tag_id,COUNT(tag_id) AS tagCount, id, tag FROM movies_tag INNER JOIN tags ON tag_id=id GROUP BY tag_id";

// Run the query and capture the result
$result = $dbc->query( $sql );

// Extract the result
$tags = json_encode( $result->fetch_all(MYSQLI_ASSOC) );

// Prepare the header to say we are about to send JSON, not text
header('Content-Type: application/json');

echo $tags;