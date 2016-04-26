<?php

// create a database connection
// data source name(DSN), username, password

try{
	$test = new PDO('mysql:host=localhost;dbname=schlock;charset=utf8', 'root', '');
	$test->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$test->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {
	echo $e->getCode();
	echo "OOPS!", $e->getMessage();
}

try {
	$test->query("TRUNCATE TABLE movies;");
	
} catch (Exception $e) {
	echo $e->getMessage();
}

try {
	$statement = $test->prepare("INSERT INTO movies (title, year, description) VALUES (:title, :year, :description);");
	if ($handle = fopen("movies.csv", "r")) {
		while ($row = fgetcsv($handle, 0, ",")){
			$statement->bindValue(":title", strtitle($row[0]));
			$statement->bindValue(":year", $row[1]);
			$statement->bindValue(":description", $row[2]);
			$statement->execute();
		}
	}
	fclose($handle);

} catch (Exception $e) {
	echo $e->getMessage();
}

function strtitle($title) {
	$exceptions = [
        'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if', 'then', 'else', 'when', 'at', 'from', 'by', 'on', 'off', 'for', 'in', 'out', 'over', 'to', 'into', 'with'
    ];

	$title =strtolower($title);
	
	$words = explode(' ', $title);
	foreach ($words as $key => $word) {
		if($key == 0 || ! in_array($word, $exceptions))
			$words[$key] = ucwords($word);
	}
	$newtitle = implode(' ',$words);
	return $newtitle;
}
