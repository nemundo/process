<?php


namespace Nemundo\Process\Workflow\Content\Status;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;


trait ProcessStatusTrait
{

    /**
     * @var bool
     */
    public $closeWorkflow = false;

    /**
     * @var bool
     */
    public $editable = false;

    /**
     * @var bool
     */
    //public $editable2 = false;


    /**
     * @var bool
     */
    public $appendDataIdParameter = false;

    /**
     * @var bool
     */
    protected $changeStatus = false;

    /**
     * @var bool
     */
    public $toggleView = false;


    public function isStatusChangeable()
    {
        return $this->changeStatus;
    }


    public function getParentProcess()
    {

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();

        /** @var AbstractProcess $process */
        $process = $contentReader->getRowById($this->getParentId())->getContentType();

        return $process;

    }

}