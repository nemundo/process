<?php


namespace Nemundo\Process\Content\Writer;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeValue;

class TreeWriter extends AbstractBase
{

    public $parentId;

    public $dataId;

    public function write()
    {

            $value = new TreeValue();
            $value->field = $value->model->itemOrder;
            $value->filter->andEqual($value->model->parentId, $this->parentId);
            $itemOrder = $value->getMaxValue();

            if ($itemOrder == '') {
                $itemOrder = -1;
            }
            $itemOrder++;

            $data = new Tree();
            $data->parentId = $this->parentId;
            $data->childId = $this->dataId;
            $data->itemOrder = $itemOrder;
            $data->save();


    }

}