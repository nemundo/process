<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Delete\TreeContentDelete;

class ContentCheckScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'content-check';
    }


    public function run()
    {

        $reader = new ContentReader();
        //$reader->model->loadContentType();
        //$reader->addGroup($reader->model->contentTypeId);
        $reader->filter->andEqual($reader->model->contentTypeId,'');
        foreach ($reader->getData() as $contentRow) {


            //(new Debug())->write('found'.$contentRow->contentType->contentType);


        }

        (new Debug())->write($reader->getCount());

        //exit;



        // check, if content type exists

        // SELECT * FROM process_content WHERE content_type=''


        $delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->contentTypeId,'');
        $delete->delete();



        // check data id
        $reader = new ContentReader();
        $reader->filter->andIsNull($reader->model->dataId);
        foreach ($reader->getData() as $contentRow) {
            (new Debug())->write('Data Id is Null. Content Id ' . $contentRow->id);
        }


        $delete = new ContentDelete();
        $delete->filter->andIsNull($delete->model->dataId);
        $delete->delete();


        $reader = new TreeReader();
        foreach ($reader->getData() as $treeRow) {


            if (!$this->checkContent($treeRow->parentId)) {
                (new Debug())->write('Parent is missing. Tree Id: ' . $treeRow->id);

                //$delete = new TreeContentDelete();
                //$delete->deleteContent();  // deleteById($treeRow->parentId);

                //(new TreeDelete())->deleteById($treeRow->id);
            }

            if (!$this->checkContent($treeRow->childId)) {
                (new Debug())->write('Child is missing. Tree Id: ' . $treeRow->id);

                //(new TreeDelete())->deleteById($treeRow->id);

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