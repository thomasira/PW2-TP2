<?php
require_once "./model/Crud.php";

class StampCategory extends Crud {
    public $table = "pw2tp2_stamp_category";
    public $compKey1 = "stamp_id";
    public $compKey2 = "category_id";
    public $fillable = ["stamp_id", "category_id"];
}