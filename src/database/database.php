<?php
  use Jenssegers\Date\Date;

  require 'connection.php';

  function add_user($email, $username, $password){
    $conn = connect();
    $success = 0;

    if($stmt = $conn->prepare("INSERT INTO `users`(`email`, `username`, `password`) VALUES (?, ?, ?)")){
      $stmt->bind_param('sss', $email, $username, $password);

      if($stmt->execute()){
        $success = 1;
      }

      $stmt->close();
    }

    $conn->close();
    return $success;
  }

  function login($email, $username, $password){
    $conn = connect();
    $user_info = array();

    if($stmt = $conn->prepare("SELECT * FROM users WHERE (`email` = ? OR `username` = ?) AND `password` = ?")){
      $stmt->bind_param('sss', $email, $username, $password);
      $stmt->execute();
      $result = $stmt->get_result();

      $user_info = $result->fetch_assoc();

      $stmt->close();
    }

    $conn->close();
    return $user_info;
  }

  function add_post($user_id, $content){
    $conn = connect();
    $success = 0;

    if($stmt = $conn->prepare("INSERT INTO `posts`(`user_id`, `content`) VALUES (?, ?)")){
      $stmt->bind_param('ss', $user_id, $content);

      if($stmt->execute()){
        $success = 1;
      }

      $stmt->close();
    }

    $conn->close();
    return $success;
  }

  function get_posts($user_id){
    $conn = connect();
    $posts = array();

    if($stmt = $conn->prepare("SELECT * FROM `posts` WHERE `user_id` = ?")){
      $stmt->bind_param('s', $user_id);
      $stmt->execute();
      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()){
        $posts[] = $row;
      }

      $stmt->close();
    }

    return $posts;
    $conn->close();
  }
?>
