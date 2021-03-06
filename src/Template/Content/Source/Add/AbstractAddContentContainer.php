<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Core\Http\Request\Post\PostRequest;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Nemundo\Process\Content\Form\AbstractContentContainer;
use Nemundo\Process\Template\Content\Source\Parameter\SourceParameter;


class AbstractAddContentContainer extends AbstractContentContainer
{


    protected $listboxLabel = 'Source';

    /**
     * @var AbstractContentTypeCollection
     */
    protected $contentTypeCollection;

    public function getContent()
    {

        $sourceParameter = new SourceParameter();

        $form = new SearchForm($this);
        $form->addUrlAsHiddenInput = true;
        $form->addInputName((new SourceParameter())->getParameterName());

        $listbox = new BootstrapListBox($form);
        $listbox->label = $this->listboxLabel;
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;
        $listbox->name = (new SourceParameter())->getParameterName();
        $listbox->value = (new PostRequest((new SourceParameter())->getParameterName()))->getValue();

        foreach ($this->contentTypeCollection->getContentTypeList() as $contentType) {
            $listbox->addItem($contentType->typeId, $contentType->typeLabel);
        }


        if ($sourceParameter->hasValue()) {

            $form = new SourceAddContentForm($this);
            $form->contentType = $this->contentType;
            $form->redirectSite = $this->redirectSite;

        }

        return parent::getContent();

    }

}