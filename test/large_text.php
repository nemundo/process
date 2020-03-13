<?php

require __DIR__.'/../../../config.php';



$type = new \Nemundo\Process\Template\Content\LargeText\LargeTextContentType(12);
$type->largeText = 'hello world';
//$type->dateTime = (new \Nemundo\Core\Type\DateTime\DateTime())->setNow()->minusDay(20);
$type->saveType();

