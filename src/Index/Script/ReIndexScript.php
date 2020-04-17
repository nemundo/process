<?php


namespace Nemundo\Process\Index\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Time\Stopwatch;
use Nemundo\Process\Content\Data\Content\ContentCount;
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

        //(new CleanIndexScript())->run();

        // large reader !!!

        $stopwatch = new Stopwatch('ReIndex');

        $totalCount = (new ContentCount())->getCount();
        $n=0;

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        foreach ($contentReader->getData() as $contentRow) {
            $contentType = $contentRow->getContentType();
            $contentType->saveIndex();

            $n++;

            if (($n % 1000) == 0) {
                (new Debug())->write("$n / $totalCount");
            }

        }

        $stopwatch->stopAndPrintOutput();

    }

}