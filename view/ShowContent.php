<?php
require_once('..\Controllers\ContentController.php');
$content = new ContentController();
echo $content->getContent();
