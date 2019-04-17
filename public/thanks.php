<?php
require '../core/session.php';

$meta=[];
$meta['title']='Thank You!';

$content=<<<EOT
<p>Thanks for your submission!</p>
EOT;

require '../core/layout.php';
