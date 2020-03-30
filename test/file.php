<?php

require __DIR__.'/../../../config.php';

$url = 'https://www.dwd.de/DWD/wetter/wv_spez/hobbymet/wetterkarten/bwk_bodendruck_na_ana.png';

$type = new \Nemundo\Process\Template\Content\File\FileContentType();
//$type->file->fromFilename('C:\test\wiki.txt');
$type->file->fromUrl($url);
//$type->file->f
$type->saveType();


