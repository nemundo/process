<?php

require __DIR__.'/../../../config.php';



$item = new \Nemundo\Process\Template\Item\LargeTextContentItem();
$item->largeText = 'hello world';
$item->saveItem();

