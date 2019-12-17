<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Content\View\ContentView;
use Nemundo\Process\Form\AbstractContentForm;
use Nemundo\Process\Form\ContentForm;
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

        $this->formClass = ContentForm::class;
        $this->viewClass = ContentView::class;

        $this->loadContentType();
    }


    public function getSubject($dataId)
    {

        $subject = $this->getClassNameWithoutNamespace();
        return $subject;

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