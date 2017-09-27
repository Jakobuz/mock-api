<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
  return "Welcome to the mock-api project!";
});

$app->get('/signup', function(Request $request, Response $response){
  return "This is the signup route";
});

$app->get('/login', function(Request $request, Response $response){
  return "This is the login route";
});

$app->post('/post', function(Request $request, Response $response){
  return "This is the post route";
});

$app->post('/user_posts', function(Request $request, Response $response){
  return "This is the user posts route";
});
