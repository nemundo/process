<?php


namespace Nemundo\Process\Status;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Form\StatusForm;
use Nemundo\Process\Template\Status\CancelStatus;
use Nemundo\Process\Template\Status\CommentStatus;
use Nemundo\Process\Template\Status\DocumentStatus;
use Nemundo\Process\View\AbstractStatusView;
use Nemundo\User\Access\UserRestrictionTrait;
use Nemundo\Process\Form\AbstractStatusForm;


// AbstractProcessStatus
abstract class AbstractStatus extends AbstractBaseClass
{

    use UserRestrictionTrait;

    /**
     * @var string
     */
    public $label;
    // status

    /**
     * @var string
     */
    public $logText;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $formClass;

    /**
     * @var string
     */
    public $viewClass;

    /**
     * @var bool
     */
    public $showMenu=true;

    public $showLog=true;

    public $closeWorkflow=false;

    /**
     * @var bool
     */
    public $editable=false;

    /**
     * @var bool
     */
    public $showSubMenu = true;

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
    private $menuStatusClassList=[];

    abstract protected function loadStatus();


    public function __construct()
    {

        $this->formClass = StatusForm::class;
        $this->loadStatus();
    }


    public function getForm(AbstractHtmlContainer $parent)
    {


        /** @var AbstractStatusForm $form */
        $form = new $this->formClass($parent);
        $form->status = $this;

        return $form;

    }



    public function hasView()
    {

        $value = false;
        if ($this->viewClass !== null) {
            $value = true;
        }

        return $value;

    }

    public function getView(AbstractHtmlContainer $parent)
    {

        /** @var AbstractStatusView $view */
        $view = new $this->viewClass($parent);

        return $view;

    }



    // nach StatusItem
    public function getLogText($dataId)
    {

        $logText = $this->logText;
        if ($logText == null) {
            $logText = $this->label;  // '[no log text]';
        }

        return $logText;

    }



    public function saveStatus() {


    }


    public function getNextStatus() {


        /** @var AbstractStatus $nextStatus */
        $nextStatus=null;

        if ($this->nextStatusClass !==null) {
            $className = $this->nextStatusClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }



    public function getMenuStatus() {


        /** @var AbstractStatus[] $statusList */
        $statusList=[];
        foreach ($this->menuStatusClassList as $className) {
          $statusList[]=new $className();
        }
        return $statusList;

        //return $this->menuStatusClassList;

    }


    // SubStatus
    /*protected function addMenuStatus(AbstractStatus $status) {

        $this->menuStatusList[]=$status;
        return $this;

    }*/


    protected function addMenuStatusClass($statusClass) {

        $this->menuStatusClassList[]=$statusClass;
        return $this;

    }






}