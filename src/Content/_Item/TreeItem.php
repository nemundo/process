<?php


namespace Nemundo\Process\Content\Item;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Data\Tree\TreeValue;

class TreeItem extends AbstractBase
{

    public $dataId;

    public $parentId;

    public function saveTree() {

        $value = new TreeValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $this->parentId);
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder = -1;
        }
        $itemOrder++;

        $data = new Tree();
        $data->parentId =$this->parentId;
        $data->childId =$this->dataId;
        $data->itemOrder=$itemOrder;
        $data->save();



    }


    public function removeTree() {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId,$this->parentId);
        $delete->filter->andEqual($delete->model->childId,$this->dataId);
        $delete->delete();


    }


}