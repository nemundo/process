<?php


namespace Nemundo\Process\Workflow\Content\Status;


use Nemundo\User\Access\UserRestrictionTrait;


trait ProcessStatusTrait
{

    use UserRestrictionTrait;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $logText;

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

    /**
     * @var string
     */
    protected $nextStatusClass;

    /**
     * @var string[]
     */
    private $menuStatusClassList = [];


    public function getSubject($dataId)
    {

        $logText = $this->logText;
        if ($logText == null) {
            $logText = $this->label;
        }

        return $logText;

    }


    public function getNextStatus()
    {

        /** @var AbstractStatus $nextStatus */
        $nextStatus = null;

        if ($this->nextStatusClass !== null) {
            $className = $this->nextStatusClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


    public function getMenuStatus()
    {

        /** @var AbstractStatus[] $statusList */
        $statusList = [];
        foreach ($this->menuStatusClassList as $className) {
            $statusList[] = new $className();
        }
        return $statusList;

    }


    protected function addMenuStatusClass($statusClass)
    {

        $this->menuStatusClassList[] = $statusClass;
        return $this;

    }

}