<?php


namespace Nemundo\Process\Workflow\Content\Status;


use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\User\Access\UserRestrictionTrait;


trait ProcessStatusTrait
{

    use UserRestrictionTrait;

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
    public $changeStatus = true;

    /**
     * @var bool
     */
    public $activeAfterWorkflowClosed = false;


    public function getParentProcess() {


        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        //(new Debug())->write($this->parentId);

        /** @var AbstractProcess $process */
        $process = $contentReader->getRowById($this->parentId)->getContentType();



        return $process;

    }

}