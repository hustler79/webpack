<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$data = json_decode(file_get_contents("php://input"), true) ?: array();

$data = array_merge($_POST, $data);

$comments = @file_get_contents('comments.json');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data['author']) && isset($data['text'])) {

    $commentsDecoded = json_decode($comments, true) ?: array();

    $commentsDecoded[] = array(
        'id'      => round(microtime(true) * 1000),
        'author'  => $data['author'],
        'text'    => $data['text']
    );

    if (version_compare(PHP_VERSION, '5.4', '>=')) {
        $comments = json_encode($commentsDecoded, JSON_PRETTY_PRINT);
    }
    else {
        $comments = json_encode($commentsDecoded);
    }

    file_put_contents('comments.json', $comments);
}

sleep(1);

header('Content-Type: application/json');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin: *');

echo $comments ?: '[]';