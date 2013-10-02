<?php

$name     = $request->get('name', 'World');
$content  = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
?>

Hello, <?php echo $content ?>