<?php 


class Category{
	private $connection;
	private $category_table = "category";
	public $id;
	public $name;

	public function __construct($db){
		$this->connection = $db;
	}


	function getAllCategories(){

		$query = "select * from " . $this->category_table . ";";

		$stmt = $this->connection->prepare($query);

		$stmt->execute();

		return $stmt;

	}


	function createCategory(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->category_table . "
            SET
                name=:name";
 

    $stmt = $this->connection->prepare($query);
 
    // sanitize
    $this->name = htmlspecialchars(strip_tags($this->name));
 
    // bind values
    $stmt->bindParam(":name", $this->name);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}


	function updateCategory() {
        // update query
        $query = "UPDATE
                " . $this->category_table . "
            SET
                name = :name
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function deleteCategory() {
        // delete query
        $query = "DELETE FROM " . $this->category_table . " WHERE id = ?;";

        // prepare query
        $stmt = $this->connection->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>