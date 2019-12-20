<?php


namespace Nemundo\Process\Content\Item;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentValue;
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
    public $mitarbeiterId;

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
        $this->mitarbeiterId = (new UserSessionType())->userId;


        $this->loadItem();

    }


    protected function loadItem() {

    }

    protected function saveContent()
    {

        if ($this->contentType == null) {
            (new LogMessage())->writeError('content type not defined' . $this->getClassName());
        }

        $value = new ContentValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $this->parentId);
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder=-1;
        }

        $data = new Content();
        $data->contentTypeId = $this->contentType->id;
        $data->parentId = $this->parentId;
        $data->dataId = $this->dataId;
        $data->dateTimeCreated = $this->dateTime;  // date (new DateTime())->setNow();
        $data->userCreatedId = $this->mitarbeiterId;
        $data->itemOrder = $itemOrder+1;
        $data->save();

    }



    public function hasParent() {

        $value = false;
        if ($this->getParentId() !=='') {
            $value=true;
        }

        return $value;

    }

    public function getParentId() {

        $value = new ContentValue();
        $value->field = $value->model->parentId;
        $value->filter->andEqual($value->model->dataId,$this->dataId);
        $parentId = $value->getValue();

        return $parentId;

    }


    public function getParentContentType() {

        $parentConentType=null;

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->dataId,$this->getParentId());
        foreach ($reader->getData() as $contentRow) {
        $parentConentType = $contentRow->contentType->getContentType();
        }

        return $parentConentType;

    }


    public function getParentContentItem() {

        $item=null;

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->dataId,$this->getParentId());
        foreach ($reader->getData() as $contentRow) {
            $item = $contentRow->contentType->getContentType()->getItem($contentRow->dataId);
        }

        return $item;

    }



    public function getChildReverse() {

     return   $this->getChildContent(SortOrder::DESCENDING);
    }


    public function getChild() {

        return   $this->getChildContent(SortOrder::ASCENDING);

    }


    // getChildData
    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);
        $reader->addOrder($reader->model->itemOrder,$sortOrder);

        return $reader->getData();



    }




    public function removeFromParent() {


    }


    public function deleteItem() {


        // kann mehrere items beinhalten !!!

        $delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->dataId, $this->dataId);
        $delete->delete();


        // delete child


    }


    public function sendToInbox($userId)
    {

        $data = new Inbox();
        $data->userId = $userId;
        $data->contentTypeId = $this->contentType->id;
        $data->dataId = $this->dataId;
        $data->save();

    }



    public function sendToTask() {


    }



    public function getSubject() {



    }




}