<?php


namespace Nemundo\Process\Content\Writer;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeValue;

// TreeBuilder
class TreeWriter extends AbstractBase
{

    public $parentId;

    public $childId;

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
        $data->ignoreIfExists = true;
        $data->parentId = $this->parentId;
        $data->childId = $this->childId;
        $data->itemOrder = $itemOrder;
        $data->save();


    }


    public function exist()
    {


        $value = false;

        $count = new TreeCount();
        $count->filter->andEqual($count->model->parentId, $this->parentId);
        $count->filter->andEqual($count->model->childId, $this->childId);
        if ($count->getCount() > 0) {
            $value = true;
        }

        return $value;

    }


}