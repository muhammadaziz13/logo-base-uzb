<?php 


class Company{
	private $connection;
	private $company_table = "company";
	public $id;
	public $name;

	public function __construct($db){
		$this->connection = $db;
	}


	function getAllCompanies(){

		$query = "select * from " . $this->company_table.";";

		$stmt = $this->connection->prepare($query);

		$stmt->execute();

		return $stmt;

	}


	function createCompany(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->company_table . "
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


	function updateCompany() {
        // update query
        $query = "UPDATE
                " . $this->company_table . "
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


    function deleteCompany() {
        // delete query
        $query = "DELETE FROM " . $this->company_table . " WHERE id = ?;";

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