<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Content\ContentUpdate;

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

            $contentType = $contentRow->getContentType();  // contentType->getContentType();

            //(new Debug())->write($contentType->getSubject());

            //$contentItem = $contentType->getItem($contentRow->id);
            //(new Debug())->write($contentItem->getSubject());


            $update = new ContentUpdate();
            $update->subject = $contentType->getSubject();
            $update->updateById($contentRow->id);

        }


    }

}