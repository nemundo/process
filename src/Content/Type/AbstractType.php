<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Model\Row\AbstractModelDataRow;
use Nemundo\Process\Content\Event\AbstractContentEvent;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Web\Parameter\AbstractUrlParameter;
use Nemundo\Web\Site\AbstractSite;

// AbstractContentType
abstract class AbstractType extends AbstractBaseClass
{

    /**
     * @var string
     */
    public $typeId;

    /**
     * @var string|string[]
     */
    public $typeLabel;

    /**
     * @var string
     */
    //private $dataId;
    protected $dataId;

    /**
     * @var bool
     */
    private $createMode = true;

    /**
     * @var string
     */
    protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;

    /**
     * @var AbstractContentEvent[]
     */
    protected $eventList=[];


    abstract protected function loadContentType();


    public function __construct($dataId = null)
    {

        $this->loadContentType();
        $this->fromDataId($dataId);

    }


    public function fromDataId($dataId = null)
    {

        if ($dataId !== null) {
            $this->dataId = $dataId;
            $this->createMode = false;
        }

        return $this;

    }


    public function getDataId()
    {

        return $this->dataId;

    }


    /**
     * @var AbstractModelDataRow
     */
    protected $dataRow;


    public function fromDataRow(AbstractModelDataRow $dataRow)
    {

        $this->dataRow = $dataRow;
        $this->fromDataId($dataRow->id);

        return $this;

    }


    protected function onDataRow()
    {
        //(new LogMessage())->writeError('getDataRow not defined'.$this->getClassName());
    }


    public function getDataRow()
    {

        if ($this->dataRow == null) {
            $this->onDataRow();
        }

        return $this->dataRow;

    }


    protected function onCreate()
    {

    }


    protected function onUpdate()
    {

        $this->onCreate();

    }


    protected function onIndex()
    {

    }


    public function saveIndex()
    {

        $this->onDataRow();
        $this->onIndex();

    }


    protected function saveData()
    {

        if (!$this->existItem()) {
            $this->onCreate();
        } else {
            $this->onUpdate();
        }

    }


    public function saveType()
    {

        $this->saveData();

    }


    //public function getForm(AbstractHtmlContainer $parent)
   public function getForm(AbstractContainer $parent)
    {

        if ($this->formClass == null) {
            (new LogMessage())->writeError('No Form' . $this->getClassName());
        }

        /** @var AbstractContentForm $form */
        $form = new $this->formClass($parent);
        $form->contentType = $this;

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


    //public function getView(AbstractHtmlContainer $parent = null)
    public function getView(AbstractContainer $parent = null)
    {

        /** @var AbstractContentView $view */
        $view = null;
        if ($this->hasView()) {

            /** @var AbstractContentView $view */
            $view = new $this->viewClass($parent);
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

            if ($this->parameterClass !==null) {
            $site->addParameter($this->getParameter());
            }
        }

        return $site;

    }


    public function getParameter()
    {

        $parameter = null;
        if ($this->parameterClass !== null) {
            /** @var AbstractUrlParameter $parameter */
            $parameter = new $this->parameterClass($this->getDataId());
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


    public function existItem()
    {

        return !$this->createMode;

    }



    public function addEvent(AbstractContentEvent $contentEvent) {

        $this->eventList[]=$contentEvent;
        return $this;

    }


}