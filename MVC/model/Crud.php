<?php

abstract class Crud extends PDO {

    public function __construct() {
        parent::__construct("mysql:host=localhost;dbname=e2395387;port=3306;charset=utf8", "root", "");
    }

    public function read( $where = null, $order = null) {
        $whereT = "";

        if ($where != null) {
            $target = $where["target"];
            $value = $where["value"];
            $whereT = "WHERE $target = $value";
        }
        $sql = "SELECT * FROM $this->table $whereT ORDER BY id $order";
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function readKeys($value1, $value2 = null){
        $andT = "";
        if($value2 != null) $and = "AND $this->compKey2 = :$this->compKey2";
        $sql = "SELECT * FROM $this->table WHERE $this->compKey1 = :$this->compKey1 $andT";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->compKey1", $value1);
        if($value2 != null) $query->bindValue(":$this->compKey2", $value2);
        $query->execute();
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    public function readId($value) {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $value);
        $query->execute();
        $count = $query->rowCount();
        if ($count != 0) return $query->fetch();
        else header("location: ../../home/error");
    }

    public function create($data) {
        $data_keys = array_fill_keys($this->fillable, "");
        $data = array_intersect_key($data, $data_keys);
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
