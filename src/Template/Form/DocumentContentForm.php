<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Item\DocumentContentItem;

class DocumentContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapFileUpload
     */
    private $document;

    public function getContent()
    {

        $this->document = new BootstrapFileUpload($this);
        $this->document->label = 'Document';
        $this->document->multiUpload = true;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        foreach ($this->document->getMultiFileRequest() as $fileRequest) {

            $builder = new DocumentContentItem();
            $builder->parentId = $this->parentId;
            $builder->fileRequest = $fileRequest;
            $builder->saveItem();

        }


    }

}