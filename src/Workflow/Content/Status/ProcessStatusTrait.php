<?php


namespace Nemundo\Process\Workflow\Content\Status;


use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\User\Access\UserRestrictionTrait;


trait ProcessStatusTrait
{

    use UserRestrictionTrait;
    use MenuTrait;

    /**
     * @var string|string[]
     */
    //public $type;
    // statusLabel

    /**
     * @var string
     */
    //public $logText;

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
    //protected $nextStatusClass;

    /**
     * @var string[]
     */
    //private $menuStatusClassList = [];


    /*
    public function getSubject($dataId)
    {

        $logText = $this->logText;
        if ($logText == null) {
            $logText = (new Translation())->getText( $this->type);
        }

        return $logText;

    }*/

/*
    public function getNextStatus()
    {

        /** @var AbstractProcessStatus $nextStatus */
     /*   $nextStatus = null;

        if ($this->nextMenuClass !== null) {
            $className = $this->nextMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


    public function getMenuStatus()
    {

        /** @var AbstractProcessStatus[] $statusList */
       /* $statusList = [];
        foreach ($this->menuStatusClassList as $className) {
            $statusList[] = new $className();
        }
        return $statusList;

    }


    protected function addMenuStatusClass($statusClass)
    {

        $this->menuStatusClassList[] = $statusClass;
        return $this;

    }*/

}