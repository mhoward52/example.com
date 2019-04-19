<?php
require '../core/bootstrap.php';

$meta=[];
$meta['title']='Michael Howard';

$content=<<<EOT
<br>
<br>
<br>
<br>

<h1>Hello, I am Michael Howard</h1>

<img class="avatar" 
src="https://i.gifer.com/3Qty.gif" alt="I love music...">

<p>Husband, Father, Prince Hall Mason, music producer/engineer...
  oh, and I kinda like computers too :-)...always working and learning...
</p>
<script>
EOT;

require '../core/layout.php';