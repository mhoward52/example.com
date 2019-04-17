<?php
require '../core/session.php';

if(!empty($_POST)){
    $_SESSION['user'] = [];
    $_SESSION['user']['id'] = 12345;
    header('LOCATION: ' . $_POST['goto']);
}

$hash = password_hash('12345', PASSWORD_DEFAULT);
var_dump(password_verify('12345g',$hash));

$meta=[];
$meta['title']="Login";
$goto=!empty($_GET['goto'])?$_GET['goto']:'/';

$content=<<<EOT
<form>
    <input name="email" value="{$goto}">
    <input type="submit" class="btn btn-primary">
</form>
EOT;

require '../core/layout.php';

