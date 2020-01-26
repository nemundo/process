<?php


namespace Nemundo\Process\Workflow\Content\Status;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;


trait ProcessStatusTrait
{

    //use UserRestrictionTrait;
    //use GroupRestrictionTrait;

    /**
     * @var bool
     */
    public $showMenu = true;

    /**
     * @var bool
     */
    public $showLog = true;

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
    public $changeStatus = false;

    /**
     * @var bool
     */
    public $activeAfterWorkflowClosed = false;


    public function getParentProcess()
    {

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();

        /** @var AbstractProcess $process */
        $process = $contentReader->getRowById($this->parentId)->getContentType();


        //(new Debug())->write($this->parentId);



        return $process;

    }

}