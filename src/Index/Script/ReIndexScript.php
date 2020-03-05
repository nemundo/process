<?php


namespace Nemundo\Process\Index\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Data\Content\ContentReader;

class ReIndexScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'index-reindex';
    }

    public function run()
    {

        (new CleanIndexScript())->run();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->getContentType();
            $contentType->saveIndex();

        }


    }

}