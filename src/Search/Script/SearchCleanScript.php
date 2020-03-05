<?php


namespace Nemundo\Process\Search\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Search\Install\SearchIndexClean;

class SearchCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'search-clean';
    }


    public function run()
    {

        (new SearchIndexClean())->cleanData();

    }

}