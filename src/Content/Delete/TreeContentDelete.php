<?php


namespace Nemundo\Process\Content\Delete;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Tree\TreeDelete;

class TreeContentDelete extends AbstractBase
{

    public $dataId;

    public function __construct($dataId)
    {
        $this->dataId=$dataId;
    }


    // delete by contentId


    public function removeFromParent()
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->childId, $this->dataId);
        $delete->delete();

    }


    public function deleteContent() {

        (new ContentDelete())->deleteById($this->dataId);

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->dataId);
        $delete->filter->orEqual($delete->model->childId, $this->dataId);
        $delete->delete();

    }



}