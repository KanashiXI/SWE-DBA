<?php
    require_once '/../include/dbConnect.php';
    class StudentModel {
        private $con;
        private $col;

        function __construct() {
            $db = new dbConnect();
            $this->con = $db->connect();
            $this->col = new MongoCollection($this->con, "student");
        }
        public function getAllStudent() {
            $cursor = $this->col->find();
            return $cursor;
        }

        public function findByName($name){
            $query = array("name"=> $name); //("name"=>"All") === {name:"All"}
            $cursor = $this->col->findOne($query);
            return $cursor;
        }

        public function search($name,$age){
            $query["name"] = array('$regex'=>new MongoRegex("/$name/"));
            if(!empty($age)){
                $query["age"] = (int)$age;
            }
            $cursor = $this->col->find($query);
            return $cursor;
        }

        public function insert($name, $age, $phone, $education, $address){
            $document = [
                "name" => $name,
                "age" => $age,
                "phone" => $phone,
                "education" => $education,
                "address" => $address
            ];

            try {
                $cur = $this->col->insert($document);
                return $cur;
            }
            catch (MongoCursorException $e) {
                return false;
            }
        }

        public function findById($id){
            $query = array("_id"=> new MongoId($id)); //("name"=>"All") === {name:"All"}
            $cursor = $this->col->findOne($query);
            return $cursor;
        }

        public function update($id, $name, $age, $phone, $education, $address){
            $document = [
                "id" => $id,
                "name" => $name,
                "age" => $age,
                "phone" => $phone,
                "education" => $education,
                "address" => $address
            ];
            $newdata = array('$set' => $document); //ข้อมูล
            $query = array("_id" => new MongoId($id) ); //เงื่อนไข
            
            try {
                $cur = $this->col->update($query, $newdata);
                return $cur;
            }
            catch (MongoCursorException $e) {
                return false;
            }
        }

        public function delete($id){
            $query = array("_id" => new MongoId($id) ); //เงื่อนไข
            
            try {
                $cur = $this->col->remove($query);
                return $cur;
            }
            catch (MongoCursorException $e) {
                return false;
            }
        }
    }
?>