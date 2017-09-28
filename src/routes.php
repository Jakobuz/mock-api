<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'database/database.php';

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
  $data = array('message'=>'Welome to the mock-api!');
  $response = $response->withJson($data);
  return $response;
});

$app->post('/signup', function(Request $request, Response $response){
  $email = $request->getParam('email');
  $username = $request->getParam('username');
  $password = md5($request->getParam('password'));
  $data = array();

  if(add_user($email, $username, $password)){
    $data['message'] = "Welcome! You have successfully signed up!";
  } else {
    $data['message'] = "Oops! There was an error signing you up.";
  }

  $response = $response->withJson($data);
  return $response;
});

$app->post('/login', function(Request $request, Response $response){
  $email = $request->getParam('email');
  $username = $request->getParam('username');
  $password = md5($request->getParam('password'));

  $data = array();
  $user_info = login($email, $username, $password);
  if(empty($user_info)){
    $data['error'] = 1;
    $data['message'] = "There's no user with such credentials.";
  }
  $data['user_info'] = $user_info;

  $response = $response->withJson($data);
  return $response;
});

$app->post('/post', function(Request $request, Response $response){
  $user_id = $request->getParam('user_id');
  $content = $request->getParam('content');
  $data = array();

  if(add_post($user_id, $content)){
    $data['message'] = "Post added!";
  } else {
    $data['message'] = "Could not add post!";
  }

  $response = $response->withJson($data);
  return $response;
});

$app->post('/user_posts', function(Request $request, Response $response){
  $user_id = $request->getParam('user_id');
  $posts = get_posts($user_id);
});
