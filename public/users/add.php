<?php
require '../../bootstrap.php';
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

checkSession();

$message=null;

$args = [
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_description'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_keywords'=>FILTER_SANITIZE_STRING, //strips HMTL
    'body'=>FILTER_UNSAFE_RAW  //NULL FILTER
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

    //Strip white space, begining and end
    $input = array_map('trim', $input);

    //Allow only whitelisted HTML
    $input['body'] = cleanHTML($input['body']);

    //Create the id
    $id = id($input['first_name']);

    //Sanitiezed insert
    $sql = 'INSERT INTO users SET id=uuid(), first_name=?, id=?, body=?';

    if($pdo->prepare($sql)->execute([
        $input['first_name'],
        $id,
        $input['body']
    ])){
       header('LOCATION:/users');
    }else{
        $message = 'Something bad happened';
    }
}

$content = <<<EOT
<h1>Add a New Post</h1>
{$message}
<form method="user">

<div class="form-group">
    <label for="first_name">Title</label>
    <input id="first_name" name="first_name" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea id="body" name="body" rows="8" class="form-control"></textarea>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="meta_description">Description</label>
        <textarea id="meta_description" name="meta_description" rows="2" class="form-control"></textarea>
    </div>

    <div class="form-group col-md-6">
        <label for="meta_keywords">Keywords</label>
        <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control"></textarea>
    </div>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';