<?php

abstract class Crud extends PDO {

    public function __construct() {
        parent::__construct("mysql:host=localhost;dbname=e2395387;port=3306;charset=utf8", "root", "");
    }

    public function read($order = null) {
        $sql = "SELECT * FROM $this->table ORDER BY id $order";
        $query = $this->query($sql);
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    public function readWhere($where) {
        $target = $where["target"];
        $value = $where["value"];
        $sql = "SELECT * FROM $this->table WHERE $target = '$value'";
        $query = $this->query($sql);
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    public function readKeys($value1, $value2 = null){
        $and = "";
        if($value2 != null) $and = "AND $this->catKey = :$this->catKey";
        $sql = "SELECT * FROM $this->table WHERE $this->stampKey = :$this->stampKey $and";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->stampKey", $value1);
        if($value2 != null) $query->bindValue(":$this->catKey", $value2);
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

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $id);
        $query->execute();
    }

    public function deleteStampCat($value1 = null, $value2 = null) {
        $and = "";
        $sql = "";
        if($value1 != null) {
            $sql = "DELETE FROM $this->table WHERE $this->stampKey = :$this->stampKey $and";
        } else {
            $sql = "DELETE FROM $this->table WHERE $this->catKey = :$this->catKey";
        }
        if($value2 != null) {
            $and = "AND $this->catKey = :$this->catKey";
        }
        $query = $this->prepare($sql);
        if($value1 != null) $query->bindValue(":$this->stampKey", $value1);
        if($value2 != null) $query->bindValue(":$this->catKey", $value2);
        $query->execute();
    }

    public function update($data) {
        $data_keys = array_fill_keys($this->fillable, "");
        $data = array_intersect_key($data, $data_keys);
        $set = "";
        $id = $data["id"];
        foreach ($data as $field => $value) $set .= " $field = :$field,"; 
        $set = rtrim($set, ",");
        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        foreach ($data as $field => $value) $query->bindValue(":$field", $value);
        if($query->execute()) return $id;
        else return $query->errorInfo(); 
    }
}

?>
