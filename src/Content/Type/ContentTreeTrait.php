<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Data\Tree\TreeValue;
use Nemundo\Process\Content\Row\ContentCustomRow;

trait ContentTreeTrait
{


    public function hasParent()
    {

        $value = false;
        if ($this->getParentCount() > 0) {
            $value = true;
        }
        return $value;

    }


    public function addChild($childId)
    {

        $value = new TreeValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $this->dataId);
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder = -1;
        }
        $itemOrder++;

        $data = new Tree();
        $data->parentId = $this->dataId;
        $data->childId = $childId;
        $data->itemOrder = $itemOrder;
        $data->save();


    }


    public function getChildReverse()
    {

        return $this->getChildContent(SortOrder::DESCENDING);
    }


    public function getChild()
    {

        return $this->getChildContent(SortOrder::ASCENDING);

    }


    public function getChildCount()
    {

        $count = new TreeCount();
        $count->filter->andEqual($count->model->parentId, $this->dataId);
        return $count->getCount();

    }


    public function getParentCount()
    {

        $count = new TreeCount();
        $count->filter->andEqual($count->model->childId, $this->dataId);
        return $count->getCount();

    }


    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);
        $reader->addOrder($reader->model->itemOrder, $sortOrder);

        /** @var ContentCustomRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {
            $doc[] = $treeRow->child;
        }

        return $doc;

    }


    public function getParentContent()
    {

        $reader = new TreeReader();
        $reader->model->loadParent();
        $reader->model->parent->loadContentType();
        $reader->filter->andEqual($reader->model->childId, $this->dataId);

        /** @var ContentRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {
            $doc[] = $treeRow->parent;
        }

        return $doc;

    }


    public function removeFromParent()
    {


    }


}