<?php
require_once '/lib/Slim/Slim/Slim.php';
require_once '/controllers/StudentController.php';

  Slim\Slim::registerAutoloader();
  $app = new Slim\Slim();

  function response($status, $response) {
    $app = \Slim\Slim::getInstance();
    $app->status($status);
    $app->contentType('application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }

  $app->get('/hello',['StudentController','index']);
  $app->get('/findByName/:All',function($name){
    StudentController::findByName($name);
  });
  $app->post('/search', function() use($app){
    StudentController::search($app->request());
  });
  $app->post('/insert', function() use($app){
    StudentController::insert($app->request());
  });
  $app->get('/findStudentById/:All',function($id){
    StudentController::findById($id);
  });
  $app->post('/update', function() use($app){
    StudentController::insert($app->request());
  });
  $app->get('/delete/:Id',function($id){
    StudentController::delete($id);
  });

  // $app->get('/', ['TestController', 'index']);
  // $app->post('/insert', function() use($app){
  //   TestController::insert($app->request());
  // });
  // $app->get('/search/:name', function ($name) {
  //   TestController::search($name);
  // });
  // $app->get('/getdata/:age', function ($age) {
  //   TestController::getdata($age);
  // });

  $app->run();
?>
