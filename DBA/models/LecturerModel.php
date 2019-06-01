<?php
    class LecturerModel {
        private $con;
        private $col;

        function __construct() {
            $db = new dbConnect();
            $this->con = $db->connect();
            $this->col = new MongoCollection($this->con, "lecturer");
        }
    }
?>