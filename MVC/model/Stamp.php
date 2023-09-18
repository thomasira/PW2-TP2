<?php
require_once "./model/Crud.php";

class Stamp extends Crud {
    public $table = "pw2tp2_stamp";
    public $primaryKey = "id";
    public $tablesMg = ["pw2tp2_category", "pw2tp2_aspect", "pw2tp2_user"];
    public $targets = [
        "pw2tp2_stamp.*",
        "pw2tp2_category.category",
        "pw2tp2_aspect.aspect",
        "pw2tp2_user.name as user_name"
    ];
}