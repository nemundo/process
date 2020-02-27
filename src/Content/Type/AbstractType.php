<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Model\Row\AbstractModelDataRow;
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

        $this->loadFromDataId($dataId);

        /*
        if ($dataId !== null) {
            $this->loadFromDataId($dataId);
        }

        $this->onLoad();*/

    }


    // fromDataId
    public function loadFromDataId($dataId = null)
    {

        $this->dataId = $dataId;
        if ($this->dataId !== null) {
            $this->createMode = false;
            $this->onLoad();
        }

        return $this;

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


    protected function onIndex() {

    }


    public function saveIndex() {
        $this->onIndex();
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
        //$form->parentId = $this->
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

    public function getView(AbstractHtmlContainer $parent = null)
    {

        $view = null;
        if ($this->hasView()) {

            /** @var AbstractContentView $view */
            $view = new $this->viewClass($parent);
            $view->dataId = $this->dataId;
            $view->contentType = $this;

        } else {

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


    public function getSubjectViewSite()
    {

        $site = $this->getViewSite();
        $site->title = $this->getSubject();

        return $site;

    }


    public function getViewSite()
    {

        $site = null;

        if ($this->viewSite !== null) {
            $site = clone($this->viewSite);
            $site->addParameter($this->getParameter());
        }

        return $site;

    }


    protected function getParameter()
    {

        $parameter = null;
        if ($this->parameterClass !== null) {
            /** @var AbstractUrlParameter $parameter */
            $parameter = new $this->parameterClass($this->dataId);
        }
        return $parameter;

    }


    protected function onDelete()
    {

    }


    public function deleteType()
    {

        $this->onDelete();

    }

}