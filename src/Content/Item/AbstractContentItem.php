<?php


namespace Nemundo\Process\Content\Item;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentId;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Data\Content\ContentValue;
use Nemundo\Process\Content\Data\Document\Document;
use Nemundo\Process\Content\Data\Document\DocumentId;
use Nemundo\Process\Content\Data\Document\DocumentRow;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Data\Tree\TreeValue;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\User\Type\UserSessionType;

abstract class AbstractContentItem extends AbstractBaseClass
{

    /**
     * @var string
     */
    public $parentId;

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $dataId;


    private $createMode = false;


    abstract public function saveItem();

    public function __construct($id = null)
    {

        if ($id == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
            $this->createMode = true;
        } else {

            $this->dataId = $id;
            //$this->loadData();

        }


        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


        $this->loadItem();

    }


    protected function loadItem()
    {

    }

    protected function saveContent()
    {

        if ($this->contentType == null) {
            (new LogMessage())->writeError('content type not defined' . $this->getClassName());
        }


        $data = new Content();
        $data->updateOnDuplicate = true;
        $data->contentTypeId = $this->contentType->id;
        //$data->dataId = $this->dataId;
        $data->id=$this->dataId;
        $data->subject = $this->getSubject();
        $data->dateTime = $this->dateTime;  // date (new DateTime())->setNow();
        $data->userId = $this->userId;

        $data->save();

        //$id = new DocumentId();
        //$id->filter->andEqual($id->model->dataId, $this->dataId);
        //$contentId = $this->getContentId();  //  $id->getId();
        //$parentContentId = $this->getParentContentId();


        if ($this->parentId !== null) {


            $tree = new TreeItem();
            $tree->parentId=$this->parentId;
            $tree->dataId = $this->dataId;
            $tree->saveTree();

            /*$id = new DocumentId();
            $id->filter->andEqual($id->model->dataId, $this->parentId);
            $parentId = $id->getId();*/


            /*
            $value = new TreeValue();
            $value->field = $value->model->itemOrder;
            $value->filter->andEqual($value->model->parentId, $this->parentId);
            $itemOrder = $value->getMaxValue();

            if ($itemOrder == '') {
                $itemOrder = -1;
            }
            $itemOrder++;

            $data = new Tree();
            $data->parentId =$this->parentId;  // $parentContentId;  //$this->getContentId();  // $parentId;
            $data->childId =$this->dataId;  // $contentId;
            $data->itemOrder=$itemOrder;
            $data->save();*/


        }




        /*
        $data = new Content();
        $data->contentTypeId = $this->contentType->id;
        //$data->parentId = $this->parentId;
        $data->dataId = $this->dataId;
        $data->dateTime = $this->dateTime;  // date (new DateTime())->setNow();
        $data->userId = $this->userId;
        //$data->itemOrder = $itemOrder + 1;
        $data->save();*/


    }


    /*
    private function getContentId()
    {

        $id =new ContentId();
        $id->filter->andEqual($id->model->dataId, $this->dataId);
        $contentId = $id->getId();

        return $contentId;

    }


    private function getParentContentId() {

        $id =new ContentId();
        $id->filter->andEqual($id->model->dataId, $this->parentId);
        $contentId = $id->getId();

        return $contentId;

    }*/


    public function hasParent()
    {


$value=false;
       if ( $this->getParentCount()>0) {
           $value=true;
       }
       return $value;


    }


    /*
    public function getParentId()
    {

        $parentId = '';

        /*
        $value = new ContentValue();
        $value->field = $value->model->parentId;
        $value->filter->andEqual($value->model->dataId, $this->dataId);
        $parentId = $value->getValue();*/

      //  return $parentId;

    //}

/*
    public function getParentContentType()
    {

        $parentConentType = null;

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->id, $this->getParentId());
        foreach ($reader->getData() as $contentRow) {
            $parentConentType = $contentRow->contentType->getContentType();
        }

        return $parentConentType;

    }


    public function getParentContentItem()
    {

        $item = null;

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->dataId, $this->getParentId());
        foreach ($reader->getData() as $contentRow) {
            $item = $contentRow->contentType->getContentType()->getItem($contentRow->dataId);
        }

        return $item;

    }*/


    public function addChild($childId) {

        $value = new TreeValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $this->dataId);
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder = -1;
        }
        $itemOrder++;

        $data = new Tree();
        $data->parentId =$this->dataId;  //$this->getContentId();  // $parentId;
        $data->childId = $childId;
        $data->itemOrder=$itemOrder;
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


    // getChildData
    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {


        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
$reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);


        /** @var ContentRow[] $doc */
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



    // recursives löschen
    public function deleteItem()
    {


       /* $id = new ContentId();
        $id->filter->andEqual($id->model->dataId,$this->dataId);
        $contentId=$id->getId();
*/


        (new ContentDelete())->deleteById($this->dataId);

        /*$delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->dataId, $this->dataId);
        $delete->delete();*/

        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId,$this->dataId);
        $delete->delete();



        // delete child
        // kann mehrere items beinhalten !!!

    }


    public function sendToInbox($userId)
    {

        $data = new Inbox();
        $data->userId = $userId;
        $data->contentTypeId = $this->contentType->id;
        $data->dataId = $this->dataId;
        $data->save();

    }


    public function sendToTask()
    {




    }


    public function getSubject()
    {

        return $this->contentType->getSubject($this->dataId);


    }


}