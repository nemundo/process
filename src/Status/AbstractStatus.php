<?php


namespace Nemundo\Process\Status;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\User\Access\UserRestrictionTrait;
use Nemundo\Process\Form\AbstractChangeRequestForm;
use Nemundo\Process\Status\Zuweisung\ZuweisungStatus;

abstract class AbstractStatus extends AbstractBaseClass
{

    use UserRestrictionTrait;

    /**
     * @var string
     */
    public $label;

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

        $this->loadStatus();
    }


    public function getForm(AbstractHtmlContainer $parent)
    {


        /** @var AbstractChangeRequestForm $form */
        $form = new $this->formClass($parent);
        $form->status = $this;

        return $form;

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


    protected function loadDefaultMenu() {


        $this->addMenuStatus(new KommentarStatus());
        $this->addMenuStatus(new DokumentStatus());
        $this->addMenuStatus(new ZuweisungStatus());
        $this->addMenuStatus(new AbbruchStatus());


    }




}