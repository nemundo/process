<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Form\AbstractContentForm;

class WikiPageContentForm extends AbstractContentForm
{

    /**
     * @var WikiPageContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    private $pageTitle;

    public function getContent()
    {

        $this->pageTitle = new BootstrapTextBox($this);
        $this->pageTitle->label = 'Wiki Title';
        $this->pageTitle->validation = true;
        $this->pageTitle->autofocus=true;

        return parent::getContent();

    }


    protected function loadUpdateForm()
    {

        $wikiRow = $this->contentType->getDataRow();
        $this->pageTitle->value= $wikiRow->title;

    }

    protected function onSubmit()
    {

        //$type = new WikiPageContentType($this->dataId);
        //$type->parentId=$this->parentId;
        $this->contentType->title = $this->pageTitle->getValue();
        $this->contentType->saveType();

        if ($this->appendParameter) {
            $this->redirectSite->addParameter(new WikiParameter($this->contentType->getDataId()));
        }

    }

}