<?php

abstract class Crud extends PDO {

    public function __construct() {
        parent::__construct("mysql:host=localhost;dbname=e2395387;port=3306;charset=utf8", "root", "");
    }

    public function read($order = null) {
        $join = "";
        if(is_array($this->targets)) $this->targets = implode(", ", $this->targets);
        if(isset($this->tablesMg))
            foreach($this->tablesMg as $tableMg) 
                $join .= "INNER JOIN $tableMg ON " . $this->table .".". $tableMg . "_id = $tableMg" . ".id";
        $sql = "SELECT $this->targets FROM $this->table $join ORDER BY id $order";
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function readId($value) {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $value);
        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) return $query->fetch();
        else header("location: ../../home/error");
    }

    public function create($data) {
        $fieldName = implode(", ", array_keys($data));
        $fieldSafe = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldSafe)";
        $query = $this->prepare($sql);
        foreach ($data as $key => $value) $query->bindValue(":$key", $value);
        $query->execute();
        return $this->lastInsertId();
    }

/*     public function delete($table, $value, $field = "id", $url = "index.php") {
        $sql = "DELETE FROM $table WHERE $field = :$field";
        $query = $this->prepare($sql);
        $query->bindValue(":$field", $value);
        $query->execute();
        header("location: $url");
    } */

    public function update($data) {
        $set = "";
        $id = $data["id"];
        foreach ($data as $field => $value) $set .= " $field = :$field,"; 
        $set = Rtrim($set, ",");
        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        foreach ($data as $field => $value) $query->bindValue(":$field", $value);
        if($query->execute()) return $id;
        else return $query->errorInfo(); 
    }
}

?>
