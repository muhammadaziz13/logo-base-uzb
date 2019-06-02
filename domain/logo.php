<?php 

class Logo{
	private $connection;
	private $logo_table = "logo";
	public $id;
	public $company;
    public 

	public function __construct($db){
		$this->connection = $db;
	}


	function getAllTag(){

		$query = "select * from " . $this->tag_table . ";";

		$stmt = $this->connection->prepare($query);

		$stmt->execute();

		return $stmt;

	}


	function createTag(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->tag_table . "
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


	function updateTag() {
        // update query
        $query = "UPDATE
                " . $this->tag_table . "
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


    function deleteTag() {
        // delete query
        $query = "DELETE FROM " . $this->tag_table . " WHERE id = ?;";

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