<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Content\Item\ContentItem;
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

    /**
     * @var string
     */
    protected $formClass;

    /**
     * @var string
     */
    protected $viewClass;

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