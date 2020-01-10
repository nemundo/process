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


    // getNextContentType
    public function getNextMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->nextMenuClass !== null) {
            $className = $this->nextMenuClass;
            $nextStatus = new $className();
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
        $data->statusId=$status->contentId;
        $data->save();

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