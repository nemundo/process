<?php


namespace Nemundo\Process\Content;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Form\AbstractContentForm;
use Nemundo\Process\Form\AbstractStatusForm;
use Nemundo\Process\Form\StatusForm;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\View\AbstractContentView;
use Nemundo\Process\View\AbstractStatusView;
use Nemundo\Process\View\ContentView;
use Nemundo\User\Access\UserRestrictionTrait;
use Nemundo\Web\View\ViewSiteTrait;


abstract class AbstractContentType extends AbstractBaseClass
{

    use ViewSiteTrait;


    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
   protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;



    abstract protected function loadContentType();


    public function __construct()
    {

        //$this->formClass = StatusForm::class;

        $this->viewClass = ContentView::class;

        $this->loadContentType();
    }


    public function getSubject($dataId) {

        $subject = $this->getClassNameWithoutNamespace();
        return $subject;



    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        if ($this->formClass == null) {
            (new LogMessage())->writeError('No Form'.$this->getClassName());
        }

        /** @var AbstractContentForm $form */
        $form = new $this->formClass($parent);
        $form->contentType=$this;

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

        $view=null;
        if ($this->hasView()) {

        /** @var AbstractContentView $view */
        $view = new $this->viewClass($parent);
        $view->contentType = $this;

        } else {
            (new LogMessage())->writeError('No View Class. Class: '.$this->getClassName());
        }

        return $view;

    }



    // nach StatusItem

    // getSubject
   /* public function getLogText($dataId)
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
   /*     $nextStatus=null;

        if ($this->nextStatusClass !==null) {
            $className = $this->nextStatusClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }



    public function getMenuStatus() {


        /** @var AbstractStatus[] $statusList */
     /*   $statusList=[];
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


   /* protected function addMenuStatusClass($statusClass) {

        $this->menuStatusClassList[]=$statusClass;
        return $this;

    }*/






}