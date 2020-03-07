<?php


namespace Nemundo\Process\Index\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;

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

     //   $reader->filter->andEqual($reader->model->contentTypeId,(new VerbesserungProcess())->typeId);

        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->getContentType();
            $contentType->saveIndex();

            //(new Debug())->write($contentType->getSubject());

        }


    }

}