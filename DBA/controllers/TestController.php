<?php
require_once '/../models/TestModel.php';

class TestController
{
   
    public function index()
    {
        $db = new TestModel();
        $cursor = $db->getAllFriends();
        //Variable to store result
        $result = array();

        //Do itteration for all document in a collection
        foreach ($cursor as $doc) {
            $tmp = array();
            $tmp["name"] = $doc["name"];
            $tmp["age"] = $doc["age"];
            array_push($result,$tmp);
        }
        response(200, $result);
    }

    public function insert($app){
        $name = $app->post('name');
        $age = $app->post('age');
        
        $db = new TestModel();
        $cur = $db->insert($name,$age);
        $res = array();
        if($cur) {
            $res["error"] = FALSE;
            $res["message"] = "Success to insert a new friend";
        } else {
            $res["error"] = TRUE;
            $res["message"] = "Failed to add a new friend";
        }
        response(200, $res);
    }

    public function search($name){
        $db = new TestModel();
        $cursor = $db->search($name);

        $result = array();
        foreach ($cursor as $doc) {
            $tmp = array();
            $tmp["name"] = $doc["name"];
            $tmp["age"] = $doc["age"];
            array_push($result,$tmp);
        }
        response(200, $result);
    }

    public function getdata($age){
        $db = new TestModel();
        $cursor = $db->getdata($age);
        response(200, $cursor);
    }
}