<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Web\Parameter\AbstractUrlParameter;
use Nemundo\Web\Site\AbstractSite;

abstract class AbstractType extends AbstractBaseClass
{


    // eigentlich protected!!! unmutable
    // getDataId()
    protected $dataId;
    //public $dataId;


    /**
     * @var string
     */
    protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;


    protected $createMode = true;
    //public $createMode = true;


    public function __construct($dataId = null)
    {

        if ($dataId == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
        } else {
            $this->dataId = $dataId;
            $this->createMode = false;
        }

        $this->onLoad();

    }


    public function getDataId()
    {

        return $this->dataId;

    }


    protected function onLoad() {

    }

    protected function onCreate()
    {

    }

    protected function onUpdate()
    {

        $this->onCreate();

    }


    public function saveType()
    {

        if ($this->createMode) {
            $this->onCreate();
        } else {
            $this->onUpdate();
        }

    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        if ($this->formClass == null) {
            (new LogMessage())->writeError('No Form' . $this->getClassName());
        }

        /** @var AbstractContentForm $form */
        $form = new $this->formClass($parent);

        if (!$this->createMode) {
        $form->dataId = $this->dataId;
        }
        $form->contentType = $this;
        $form->createMode=$this->createMode;

        //(new Debug())->write('set create mode');
        //(new Debug())->write($this->createMode);


        return $form;

    }


    public function hasForm()
    {
        $value = false;
        if ($this->formClass !== null) {
            $value = true;
        }
        return $value;
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

        $view = null;
        if ($this->hasView()) {

            /** @var AbstractContentView $view */
            $view = new $this->viewClass($parent);
            //$view->contentType = $this;
            $view->dataId = $this->dataId;


        } else {
            (new LogMessage())->writeError('No View Class. Class: ' . $this->getClassName());
        }

        return $view;

    }


    /**
     * @var AbstractSite
     */
    protected $viewSite;

    /**
     * @var string
     */
    protected $parameterClass;


    public function hasViewSite()
    {

        $value = false;
        if ($this->viewSite !== null) {
            $value = true;
        }

        return $value;

    }


    public function getViewSite()
    {

        /*if ($this->viewSite == null) {
            (new LogMessage())->writeError('No View Site'.$this->getClassName());
        }

        if ($this->parameterClass == null) {
            (new LogMessage())->writeError('No Parameter'.$this->getClassName());
        }*/


        $parameter = null;
        $site = null;

        if ($this->parameterClass !== null) {
            /** @var AbstractUrlParameter $parameter */
            $parameter = new $this->parameterClass($this->dataId);
        }

        if ($this->viewSite !== null) {
            $site = clone($this->viewSite);
            $site->addParameter($parameter);
            $site->title = $this->getSubject($this->dataId);

        }

        return $site;

    }


    protected function onDelete() {

    }


    public function deleteType()
    {

        $this->onDelete();

    }

}