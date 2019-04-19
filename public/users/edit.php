<?php
require '../../core/bootstrap.php';
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

checkSession();

use About\Validation;
$valid = new About\Validation\Validate();
$message=null;
$args = [
    'id'=>FILTER_SANITIZE_STRING, //strips HMTL
    'email'=>FILTER_SANITIZE_STRING, //strips HMTL
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'last_name'=>FILTER_SANITIZE_STRING, //strips HMTL
];
$input = filter_input_array(INPUT_POST, $args);
//1. First validate
if(!empty($input)){
    $valid->validation = [
        'email'=>[[
            'rule'=>'email',
            'message'=>'Please enter a valid email'
        ],[
            'rule'=>'notEmpty',
            'message'=>'Please enter an email'
        ]]
    ];
    $valid->check($input);
    if(empty($valid->errors)){
        //2. Only process if we pass validation
        //Strip white space, begining and end
        $input = array_map('trim', $input);
    
        //Allow only whitelisted HTML
        //$input['body'] = cleanHTML($input['body']);
    
        //Create the id
        $id = id($input['email']);
    
        //Sanitiezed insert
        $sql = 'UPDATE users SET email=:email, id=:id, /*body=:body,*/ first_name=:first_name, last_name=:last_name WHERE id=:id';
    
        if($pdo->prepare($sql)->execute([
            'id'=>$input['id'],
            'email'=>$input['email'],
            'id'=>$id,
            //'body'=>$input['body'],
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name']
        ])){
            header('LOCATION:/users');
        }else{
            $message = 'Something bad happened';
        }
    }else{
        //3. If validation fails create a message, DO NOT forget to add the validation 
        //methods to the form.
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }
}
/* Preload the page */
$args = [
    'id'=>FILTER_SANITIZE_STRING
];
$getParams = filter_input_array(INPUT_GET, $args);
$sql = 'SELECT * FROM users WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'id'=>$getParams['id']
]);
$row = $stmt->fetch();
$fields=[];
$fields['id']=$row['id'];
$fields['email']=$row['email'];
//$fields['body']=$row['body'];
$fields['first_name']=$row['first_name'];
$fields['last_name']=$row['last_name'];
if(!empty($input)){
    $fields['id']=$valid->userInput('id');
    $fields['email']=$valid->userInput('email');
    //$fields['body']=$valid->userInput('body');
    $fields['first_name']=$valid->userInput('first_name');
    $fields['last_name']=$valid->userInput('last_name');
}
$meta=[];
$meta['title']="Edit: {$fields['email']}";

$content = <<<EOT
<h1>{$meta['email']}</h1>
{$message}
<form method="post">
<input name="id" type="hidden" value="{$fields['id']}">
<div class="form-group">
    <label for="email">Title</label>
    <input id="email" name="email" type="text" class="form-control" value="{$fields['email']}">
    <div class="text-danger">{$valid->error('email')}</div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label for="first_name">Description</label>
        <textarea id="first_name" name="first_name" rows="2" class="form-control">{$fields['first_name']}</textarea>
    </div>
    <div class="form-group col-md-6">
        <label for="last_name">Keywords</label>
        <textarea id="last_name" name="last_name" rows="2" class="form-control">{$fields['last_name']}</textarea>
    </div>
</div>
<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
<hr>
<div>
    <a 
        class="btn btn-danger"
        onclick="return confirm('Are you sure?')"
        href="/users/delete.php?id={$fields['id']}">
            <i class="fa fa-trash" aria-hidden="true"></i>
            Delete
    </a>
</div>
EOT;

include '../../core/layout.php';