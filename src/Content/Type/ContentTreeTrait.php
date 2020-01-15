<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Debug\Debug;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Data\Tree\TreeValue;
use Nemundo\Process\Content\Parameter\ContentParameter;
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
        //$value->filter->andEqual($value->model->parentId, $this->dataId);
        $value->filter->andEqual($value->model->parentId, $this->getContentId());
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder = -1;
        }
        $itemOrder++;

        $data = new Tree();
        $data->parentId = $this->getContentId();
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
         $count->filter->andEqual($count->model->parentId, $this->getContentId());
        return $count->getCount();

    }


    public function getParentCount()
    {

        $count = new TreeCount();
        $count->filter->andEqual($count->model->childId, $this->getContentId());
        return $count->getCount();

    }


    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());

        $reader->addOrder($reader->model->itemOrder, $sortOrder);

        /** @var ContentCustomRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {

            $treeRow->child->version = $treeRow->itemOrder+1;

            $doc[] = $treeRow->child;
        }

        return $doc;

    }

    public function removeFromParent()
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId,$this->parentId);
         $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();

    }


    public function removeChild($childId)
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId,$this->getContentId());
        $delete->filter->andEqual($delete->model->childId, $childId);
        $delete->delete();

    }


    public function getParentId() {

        $parentId=null;

        $reader = new TreeReader();
        //$reader->model->loadParent();
        //$reader->model->parent->loadContentType();
        //$reader->filter->andEqual($reader->model->childId, $this->dataId);
        $reader->filter->andEqual($reader->model->childId, $this->getContentId());

        foreach ($reader->getData() as $treeRow) {
            //$doc[] = $treeRow->parent;
$parentId = $treeRow->parentId;
        }

        // warning if more than one parent!!!

        return $parentId;

    }


    // getParentContentRow

    public function getParentContent()
    {

        $reader = new TreeReader();
        $reader->model->loadParent();
        $reader->model->parent->loadContentType();
         $reader->filter->andEqual($reader->model->childId, $this->getContentId());

        /** @var ContentCustomRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {
            $doc[] = $treeRow->parent;
        }

        return $doc;

    }



    public function getParentContentType() {

       $parentContentType=null;
        foreach ($this->getParentContent() as $contentRow) {
            $parentContentType = $contentRow->getContentType();
        }

        return $parentContentType;


    }


}