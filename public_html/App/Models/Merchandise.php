<?php

namespace App\Models;

class Merchandise extends DatabaseModel
{
	
	protected static $tableName = "merchandise";
	protected static $columns = ['id','name','price','description'];
	
}