<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Process\Content\Data\ContentStatus\ContentStatus;
use Nemundo\Process\Content\Data\ContentStatus\ContentStatusReader;

abstract class AbstractSequenceContentType extends AbstractTreeContentType
{

    use MenuTrait;

    /**
     * @var AbstractMenuContentType
     */
    public $startContentType;

    /**
     * @var string
     */
    protected $nextMenuClass;

    /**
     * @var string
     */
    protected $previousMenuClass;


    public function hasNextMenu() {

        $value = false;
        if ($this->nextMenuClass !== null) {
            $value=true;
        }
        return $value;
    }


    // getNextContentType

    public function getNextMenu()
    {

        /** @var AbstractMenuContentType|AbstractSequenceContentType $nextStatus */
        $nextStatus = null;

        if ($this->nextMenuClass !== null) {
            $className = $this->nextMenuClass;
            $nextStatus = new $className();
            $nextStatus->parentId = $this->parentId;
        }

        return $nextStatus;

    }


    public function getPreviousMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->previousMenuClass !== null) {
            $className = $this->previousMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


    public function changeStatus(AbstractContentType $status) {

        $data=new ContentStatus();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->dataId;
        $data->statusId=$status->typeId;
        $data->save();

        return $this;

    }

    public function getStatus() {


        $contentStatusReader=new ContentStatusReader();
        $contentStatusReader->model->loadStatus();
        $contentStatusReader->filter->andEqual($contentStatusReader->model->contentId,$this->dataId);
        $contentStatusRow =$contentStatusReader->getRow();

//        $table->addLabelValue('Status Content Type',$contentStatusRow->status->contentType);

        $status = $contentStatusRow->status->getContentType();

        return $status;


    }


}