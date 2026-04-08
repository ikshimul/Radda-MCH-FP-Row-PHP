<?php 
class Database 
{
	protected array $arr = [];
	
	protected function database_connect()
	{
		$host='localhost';
		$user='root';
		$password='';
		$db_name='vmis';
		$connection=mysqli_connect($host,$user,$password,$db_name);
		if(!$connection)
		{
			die('database connection faild!'.mysqli_error($connection));
		}
		return $connection;
	}
	
	protected function setTitle($title){
    $this->arr['title'] = $title;
	return $this->arr['title'];
    }
}