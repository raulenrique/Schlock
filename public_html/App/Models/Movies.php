<?php

namespace App\Models;
use PDO;
use finfo;
use Intervention\Image\ImageManagerStatic as Image;

class Movies extends DatabaseModel
{
	
	protected static $tableName = "movies";
	protected static $columns = ['id','title','year','description','poster'];
	protected static $fakeColumns = ['tags'];
	protected static $validationRules = [
					"title" 		=> "minlength:1",
					"year" 			=> "minlength:4,maxlength:4,numeric",
					"description" 	=> "minlength:10"

	];
	public function comments()
	{
		$result = Comment::allBy('movie_id', $this->id);
		return $result;
	}
	public function getTags()
	{
		$models = [];
		$db = static::getDatabaseConnection(); 

		$query =" SELECT id, tag FROM tags ";
		$query .= " JOIN movies_tag ON id = tag_id ";
		$query .= " WHERE movie_id =:id";

		$statement= $db->prepare($query);
		$statement->bindValue(":id", $this->id);
		$statement->execute();

		while($record = $statement->fetch(PDO::FETCH_ASSOC)){
			$model = new Tags();
			$model->data = $record;
			array_push($models, $model);
		}
		return $models;
	}
	public function loadTags()
	{
		$tags = $this->getTags();
		$taglist = [];
		foreach ($tags as $tag) {
			array_push($taglist, $tag->tag);
		}
		$this->tags = implode(",", $taglist);
	}
	public function saveTags()
	{
		// take the string from tags property
		//  explode it into an array
		$tags = explode(",", $this->tags);
		foreach ($tags as $tag) {
			$tag = trim($tag);
		}

		$db = static::getDatabaseConnection();

		$db->beginTransaction();

		try {
			$this->addNewTags($db, $tags);
			$tagIds = $this->getTagIds($db, $tags);
			$this->deleteAllTagsFromMovie($db);
			$this->insertTagsForMovie($db, $tagIds);
	
			$db->commit();

		} catch (Exception $e) {

			$db->rollback();
			throw $e;
		}
	}
	private function addNewTags($db, $tags)
	{
		// insert each tag into the tags table (ignore all duplicates)
		$query = "INSERT IGNORE INTO tags (tag) VALUES ";

		$tagvalues = [];
		for ($i=0; $i < count($tags); $i++) { 
			array_push($tagvalues, "(:tag{$i})");
		}
		$query .= implode(",", $tagvalues);
		$statement = $db->prepare($query);
		for ($i=0; $i < count($tags); $i++) { 
			$statement->bindValue(":tag{$i}", $tags[$i]);
		}
		$statement->execute();	
	}
	private function getTagIds($db, $tags)
	{
		//getting the Id for each tags
		$query = "SELECT id FROM tags WHERE ";
		$tagvalues = [];
		for ($i=0; $i < count($tags); $i++) { 
			array_push($tagvalues, "tag =:tag{$i}");
		}
		$query .= implode(" OR ", $tagvalues);
		$statement = $db->prepare($query);
		for ($i=0; $i < count($tags); $i++) { 
			$statement->bindValue(":tag{$i}", $tags[$i]);
		}
		$statement->execute();

		$record = $statement->fetchAll(PDO::FETCH_COLUMN);
		return $record;
	}
	private function insertTagsForMovie($db, $tagIds)
	{
		$query = "INSERT IGNORE INTO movies_tag (movie_id, tag_id) VALUES ";

		$tagvalues = [];
		for ($i=0; $i < count($tagIds); $i++) { 
			array_push($tagvalues, "(:movie_id_{$i}, :tag_id_{$i})");
		}
		$query .= implode(",", $tagvalues);
		$statement = $db->prepare($query);
		for ($i=0; $i < count($tagIds); $i++) { 
			$statement->bindValue(":movie_id_{$i}", $this->id);
			$statement->bindValue(":tag_id_{$i}", $tagIds[$i]);
		}
		$statement->execute();
	}
	private function deleteAllTagsFromMovie($db)
	{
		$query = "DELETE FROM movies_tag WHERE movie_id= :movie_id";
		$statement = $db->prepare($query);
		$statement->bindValue(":movie_id", $this->id);
		$statement->execute();
	}
	public function savePoster($filename)
	{
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime = $finfo->file($filename);
		
		$extensions = [
			'image/jpg'	=> '.jpg',
			'image/jpeg'=> '.jpg',
			'image/png'	=> '.png',
			'image/gif'	=> '.gif'
		];

		if(isset($extensions[$mime])){
			$extension = $extensions[$mime];
		} else {
			$extension = '.jpg';
		}

		$newFileName = uniqid() . $extension;
		
		$folder = "./images/poster/originals";
		if( ! is_dir($folder)){
			mkdir($folder, 0777, true);
		}
		$destination = $folder . "/" . $newFileName;
		move_uploaded_file($filename, $destination);

		$this->poster = $newFileName;

		//240X300 image file size
		if( ! is_dir("./images/poster/300h")){
			mkdir("./images/poster/300h/", 0777, true);
		}
		$img = Image::make($destination);
		$img->fit(240,300);
		$img->save("./images/poster/300h/" . $newFileName);

		// 80X100 image file size
		if( ! is_dir("./images/poster/100h")){
			mkdir("./images/poster/100h/", 0777, true);
		}

		$img = Image::make($destination);
		$img->fit(80,100);
		$img->save("./images/poster/100h/" . $newFileName);
	}
	public static function search($searchQuery)
	{
		$models =[];

		$db = static::getDatabaseConnection();
		
		$query = "SET @searchterm = :searchQuery ";
		$statement = $db->prepare($query);
		$statement->bindValue(":searchQuery", $searchQuery);
		$result = $statement->execute();
		// var_dump($result);

		$query = "
					SELECT movies.id, title, year, description, taglist, 
						MATCH(title) AGAINST(@searchterm) * 2 AS score_title, 
						MATCH(description) AGAINST(@searchterm) AS score_description,
						MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE) * 1.5 AS score_tag
					FROM movies
					LEFT JOIN (
						SELECT movie_id, GROUP_CONCAT(tag SEPARATOR ' ') AS taglist FROM tags
						RIGHT JOIN movies_tag ON movies_tag.tag_id = id
						GROUP BY movie_id) AS tags ON movies.id = movie_id
					WHERE 
						MATCH(title) AGAINST(@searchterm) OR
						MATCH(description) AGAINST(@searchterm) OR
						MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE)
						ORDER BY (score_title + score_description + score_tag) DESC";

		$statement = $db->prepare($query);
		// var_dump($statement);
		$record = $statement->execute();
		// var_dump($record);
		while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
			$model = new Movies();
			$model->data = $record;
			array_push($models, $model);
		}
		return $models;
	}
}