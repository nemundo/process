<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Tree\TreeReader;

class ContentCheckScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'content-check';
    }


    public function run()
    {


        // check data id




        $reader = new TreeReader();
        foreach ($reader->getData() as $treeRow) {


            if (!$this->checkContent($treeRow->parentId)) {
                (new Debug())->write('Tree Id: '.$treeRow->id);
            }

            if (!$this->checkContent($treeRow->childId)) {
                (new Debug())->write('Tree Id: '.$treeRow->id);
            }


        }


    }

    private function checkContent($contentId)
    {

        $found = false;
        $count = new ContentCount();
        $count->filter->andEqual($count->model->id, $contentId);
        if ($count->getCount() > 0) {
            $found = true;
        }

        return $found;


    }

}