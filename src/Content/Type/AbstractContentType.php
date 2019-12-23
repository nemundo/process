<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Content\Item\ContentItem;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Content\View\ContentView;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\Form\ContentForm;
use Nemundo\Web\View\ViewSiteTrait;


abstract class AbstractContentType extends AbstractBaseClass
{

    use ViewSiteTrait;

    /**
     * @var string
     */
    public $id;

    public $type;


    /**
     * @var string
     */
    protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;
    // -->


    /**
     * @var string
     */
    public $listClass;
//listClass



    // teaserView

    // adminViewClass

    // listViewClass

    // searchViewClass



    /**
     * @var string
     */
    protected $itemClass;


    abstract protected function loadContentType();


    public function __construct()
    {

        $this->formClass = ContentForm::class;
        $this->viewClass = ContentView::class;
        $this->itemClass=ContentItem::class;

        $this->viewSite=ContentItemSite::$site;
        $this->parameterClass=DataIdParameter::class;

        $this->loadContentType();
    }


    // move to Item
    public function getSubject($dataId)
    {

        $subject = $this->getClassNameWithoutNamespace();
        return $subject;

    }


    public function getItem($dataId) {

        /** @var AbstractContentItem $item */
        $item = new $this->itemClass($dataId);

        return $item;

    }

    public function getForm(AbstractHtmlContainer $parent)
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


    public function hasList()
    {

        $value = false;
        if ($this->listClass !== null) {
            $value = true;
        }

        return $value;

    }

    public function getList(AbstractHtmlContainer $parent)
    {

        if ($this->listClass == null) {
            (new LogMessage())->writeError('No Table' . $this->getClassName());
        }

        /** @var AbstractContentList $list */
        $list = new $this->listClass($parent);

        return $list;

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
            $view->contentType = $this;

        } else {
            (new LogMessage())->writeError('No View Class. Class: ' . $this->getClassName());
        }

        return $view;

    }

}