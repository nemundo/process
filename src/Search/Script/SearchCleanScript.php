<?php


namespace Nemundo\Process\Search\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Search\Install\SearchClean;

class SearchCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'search-clean';
    }


    public function run()
    {

        (new SearchClean())->cleanData();

    }

}