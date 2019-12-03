<?php


namespace Nemundo\Process\Status;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Form\StatusForm;
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
     * @var AbstractStatus
     */
    public $nextStatus;


    /**
     * @var AbstractStatus[]
     */
    private $menuStatusList=[];

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

        //$view->status = $this;

        return $view;

    }



    public function getLogText($dataId)
    {

        $text = $this->label;  // '[no log text]';
        return $text;

    }



    public function saveStatus() {


    }




    public function getMenuStatus() {
        return $this->menuStatusList;
    }


    // SubStatus
    protected function addMenuStatus(AbstractStatus $status) {

        $this->menuStatusList[]=$status;
        return $this;

    }






}