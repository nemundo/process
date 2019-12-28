<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Install\ContentUninstall;

class ContentUpdateScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'content-update';
    }


    public function run()
    {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->contentType->getContentType();
            $contentItem = $contentType->getItem($contentRow->id);
            //(new Debug())->write($contentItem->getSubject());


            $update = new ContentUpdate();
            $update->subject= $contentItem->getSubject();
            $update->updateById($contentRow->id);

        }


    }

}