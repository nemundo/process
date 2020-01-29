<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Web\Parameter\AbstractUrlParameter;
use Nemundo\Web\Site\AbstractSite;

abstract class AbstractType extends AbstractBaseClass
{

    /**
     * @var string
     */
    protected $dataId;

    /**
     * @var bool
     */
    protected $createMode = true;
    // oder public

    /**
     * @var bool
     */
    //protected $ignoreMode = false;



    /**
     * @var string
     */
    protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;


    public function __construct($dataId = null)
    {

        if ($dataId !== null) {
            $this->loadFromDataId($dataId);
        }

        $this->onLoad();

    }


    // fromDataId
    // fromContentId
    public function loadFromDataId($dataId) {
        $this->dataId = $dataId;
        $this->createMode = false;
    }


    public function getDataId()
    {

        return $this->dataId;

    }


    protected function onLoad()
    {

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
        $form->createMode = $this->createMode;


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

            if (class_exists($this->viewClass)) {

            /** @var AbstractContentView $view */
            $view = new $this->viewClass($parent);
            $view->dataId = $this->dataId;
            $view->contentType = $this;
            } else {
                (new LogMessage())->writeError('No View Class. Class: ' . $this->getClassName());
            }

        } else {
            //(new LogMessage())->writeError('No View Class. Class: ' . $this->getClassName());

            $view = new Paragraph($parent);
            $view->content = '[No View]';

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


    protected function onDelete()
    {

    }


    public function deleteType()
    {

        $this->onDelete();

    }

}