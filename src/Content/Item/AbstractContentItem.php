<?php


namespace Nemundo\Process\Content\Item;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentValue;

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

    abstract public function saveItem();

    /**
     * @var string
     */
    public $dataId;


    private $createMode = false;

    public function __construct($id = null)
    {

        if ($id == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
            $this->createMode = true;
        } else {

            $this->dataId = $id;
            //$this->loadData();

        }

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
        $data->dateTimeCreated = (new DateTime())->setNow();
        $data->itemOrder = $itemOrder+1;
        $data->save();

    }



    public function hasParent() {

    }

    public function getParentId() {

        $value = new ContentValue();
        $value->field = $value->model->parentId;
        $value->filter->andEqual($value->model->dataId,$this->dataId);
        $parentId = $value->getValue();

        return $parentId;

    }



    // getChildData
    public function getChildContent()
    {


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);
        $reader->addOrder($reader->model->itemOrder);

        return $reader->getData();



    }






    protected function deleteItem() {

    }


    public function sendToInbox($userId)
    {

        $data = new Inbox();
        $data->userId = $userId;
        $data->contentTypeId = $this->contentType->id;
        $data->dataId = $this->dataId;
        $data->save();

    }


    public function getSubject() {



    }




}