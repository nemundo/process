<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Form\AbstractContentForm;

class WikiPageContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapTextBox
     */
    private $pageTitle;

    public function getContent()
    {

        $this->pageTitle=new BootstrapTextBox($this);
        $this->pageTitle->label = 'Wiki Title';
        $this->pageTitle->validation=true;

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        $item = new WikiPageContentItem($this->dataId);
        $item->title=$this->pageTitle->getValue();
        $item->saveItem();

        $this->redirectSite->addParameter(new WikiParameter($item->dataId));

        // TODO: Implement onSubmit() method.
    }

}