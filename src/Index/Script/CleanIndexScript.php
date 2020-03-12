<?php


namespace Nemundo\Process\Index\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexDelete;
use Nemundo\Process\App\Calendar\Install\CalendarIndexClean;
use Nemundo\Process\App\Document\Install\DocumentIndexClean;
use Nemundo\Process\App\Task\Install\TaskIndexClean;
use Nemundo\Process\Search\Install\SearchIndexClean;
use Schleuniger\App\Task\Install\TaskClean;

class CleanIndexScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName='index-clean';
    }

    public function run()
    {

        (new DocumentIndexClean())->cleanData();
        (new SearchIndexClean())->cleanData();
        (new TaskIndexClean())->cleanData();
        (new CalendarIndexClean())->cleanData();


    }

}