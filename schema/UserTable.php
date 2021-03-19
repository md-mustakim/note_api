<?php
    namespace schema;
    class UserTable{
        public function __construct(){

        }
        public function create(){
            $sql = "create table users(
    id int,
    user varchar(15),
    pass text,
    email varchar(50),
    pass_change int,
    reg_time timestamp
);";

        }
    }