<?php

require '../../core/db_connect.php';

$args = [
    'slug'=>FILTER_SANITIZE_STRING,
];

$input = filter_input_array(INPUT_GET, $args);
$slug = preg_replace("/[^a-z0-9-]+/", "", $input['slug']);

$content=null;
$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = ?');
$stmt->execute([$slug]);

$row = $stmt->fetch();
$content .= "<h1>{$row['title']}</h1>";

require '../../core/layout.php';