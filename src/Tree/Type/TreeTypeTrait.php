<?php


namespace Nemundo\Process\Tree\Type;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Data\Tree\TreeValue;
use Nemundo\Process\Content\Row\ContentCustomRow;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;


// childtrait
// parenttrait


trait TreeTypeTrait
{

    /**
     * @var string
     */
    public $parentId;


    protected function saveTree()
    {

        if ($this->parentId !== null) {
            $writer = new TreeWriter();
            $writer->parentId = $this->parentId;
            $writer->childId = $this->getContentId();
            $writer->write();
        }

    }


    protected function deleteTree()
    {

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->getContentId());
        $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();

    }


    protected function deleteChild()
    {

        foreach ($this->getChild() as $customRow) {

            $type = $customRow->getContentType();
            $type->deleteType();

        }

    }


    public function hasParent()
    {

        $value = false;
        if ($this->getParentCount() > 0) {
            $value = true;
        }
        return $value;

    }


    // braucht es diese Function???, ja zum anhängen
    public function addChild($childId)
    {

        $writer = new TreeWriter();
        $writer->parentId = $this->getContentId();
        $writer->childId=$childId;
        $writer->write();

        $this->saveIndex();



        /*
        $value = new TreeValue();
        $value->field = $value->model->itemOrder;
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
        $data->save();*/


    }


    public function getChildReverse()
    {

        return $this->getChildContent(SortOrder::DESCENDING);
    }


    public function getChild()
    {

        return $this->getChildContent(SortOrder::ASCENDING);

    }


    public function getChildContentTypeList() {

        /** @var AbstractTreeContentType[]|NotificationTrait[] $list */
        $list = [];

        foreach ($this->getChild() as $contentCustomRow) {
          $list[] = $contentCustomRow->getContentType();
        }

        return $list;

    }




    //getLastOf
    // getFirstOf
    // getChildOf


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


    public function getFirst()
    {
        return $this->getChildRow(SortOrder::ASCENDING);
    }


    public function getLast()
    {
        return $this->getChildRow(SortOrder::DESCENDING);
    }


    public function getFirstOf(AbstractTreeContentType $contentType)
    {
        return $this->getFilterChildRow($contentType, SortOrder::ASCENDING);

    }


    public function getLastOf(AbstractTreeContentType $contentType)
    {

        return $this->getFilterChildRow($contentType, SortOrder::DESCENDING);

    }


    public function existsChildOf(AbstractTreeContentType $contentType)
    {

        $value = false;
        if ($this->getCountOf($contentType) > 0) {
            $value = true;
        }
        return $value;
    }


    // getChildCountOf
    public function getCountOf(AbstractTreeContentType $contentType)
    {

        $treeCount = new TreeCount();
        $treeCount->model->loadChild();
        $treeCount->filter->andEqual($treeCount->model->parentId, $this->getContentId());
        $treeCount->filter->andEqual($treeCount->model->child->contentTypeId, $contentType->typeId);

        return $treeCount->getCount();

    }


    private function getChildRow($sortOrder)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        //$reader->filter->andEqual($reader->model->child->contentTypeId, $filterContentType->typeId);
        $reader->addOrder($reader->model->itemOrder, $sortOrder);
        $reader->limit = 1;

        /** @var ContentCustomRow $doc */
        $doc = null;
        foreach ($reader->getData() as $treeRow) {
            $doc = $treeRow->child;
        }

        return $doc;

    }


    private function getFilterChildRow(AbstractTreeContentType $filterContentType, $sortOrder)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        $reader->filter->andEqual($reader->model->child->contentTypeId, $filterContentType->typeId);
        $reader->addOrder($reader->model->itemOrder, $sortOrder);
        $reader->limit = 1;

        /** @var ContentCustomRow $doc */
        $doc = null;
        foreach ($reader->getData() as $treeRow) {
            $doc = $treeRow->child;
        }

        return $doc;

    }


    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {

        $contentId = $this->getContentId();

        /** @var ContentCustomRow[] $childList */
        $childList = [];

        if ($contentId !== null) {

            $reader = new TreeReader();
            $reader->model->loadChild();
            $reader->model->child->loadContentType();
            $reader->model->child->loadUser();
            $reader->filter->andEqual($reader->model->parentId, $contentId);
            $reader->addOrder($reader->model->itemOrder, $sortOrder);
            foreach ($reader->getData() as $treeRow) {
                $treeRow->child->itemOrder = $treeRow->itemOrder;
                $childList[] = $treeRow->child;
            }

        }

        return $childList;

    }


    public function removeFromParent()
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId, $this->parentId);
        $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();

    }


    public function removeChild($childId)
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId, $this->getContentId());
        $delete->filter->andEqual($delete->model->childId, $childId);
        $delete->delete();

    }


    public function getParentId()
    {

        if ($this->parentId == null) {

            $parentCount = 0;

            $reader = new TreeReader();
            $reader->filter->andEqual($reader->model->childId, $this->getContentId());
            foreach ($reader->getData() as $treeRow) {
                $this->parentId = $treeRow->parentId;
                $parentCount++;
            }


            if ($parentCount > 1) {
                (new LogMessage())->writeError('getParentId. More than one parent. Content Id: ' . $this->getContentId());
            }

        }

        return $this->parentId;

    }


    // getParentContentRow

    /**
     * @return ContentCustomRow[]
     */
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


    public function getParentContentType()
    {

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();

        /** @var AbstractTreeContentType $parentContentType */
        $parentContentType = $contentReader->getRowById($this->getParentId())->getContentType();

        return $parentContentType;

    }


    public function getParentDataId()
    {

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $dataId = $contentReader->getRowById($this->getParentId())->dataId;

        return $dataId;

    }

}