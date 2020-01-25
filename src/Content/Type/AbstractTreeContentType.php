<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\App\Performance\PerformanceStopwatch;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Writer\TreeWriter;


abstract class AbstractTreeContentType extends AbstractContentType
{

    use ContentTreeTrait;

    /**
     * @var string
     */
    public $parentId;


    public function saveType()
    {

        $stop=new PerformanceStopwatch('save_content');
        $this->saveContent();
        $stop->stopStopwatch();

        $stop=new PerformanceStopwatch('save_tree');
        $this->saveTree();
        $stop->stopStopwatch();

        $stop=new PerformanceStopwatch('search_index');
        $this->saveSearchIndex();
        $stop->stopStopwatch();

        $stop=new PerformanceStopwatch('finished');
        $this->onFinished();
        $stop->stopStopwatch();

    }



    protected function saveTree() {

        if ($this->parentId !== null) {
            $writer = new TreeWriter();
            $writer->parentId = $this->parentId;
            $writer->dataId = $this->contentId;
            $writer->write();
        }

    }


    protected function onFinished() {

    }


    public function deleteType()
    {

        parent::deleteType();

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->getContentId());
        $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();

        $this->deleteSearchIndex();

    }


    protected function deleteChild()
    {

        foreach ($this->getChild() as $customRow) {

            $type = $customRow->getContentType();
            $type->deleteType();

        }

    }


    public function getText()
    {

        $text = '[No Text]';
        return $text;

    }

}