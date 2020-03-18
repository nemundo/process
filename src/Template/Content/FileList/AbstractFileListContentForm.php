<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;

abstract class AbstractFileListContentForm extends AbstractContentForm
{

    /**
     * @var AbstractFileListContentType
     */
    public $contentType;

    /**
     * @var BootstrapFileUpload
     */
    protected $file;

    /**
     * @var Div
     */
    private $listDiv;


    protected function loadContainer()
    {
        parent::loadContainer();

        $this->listDiv = new Div($this);
        $this->file = new BootstrapFileUpload($this);

    }


    public function getContent()
    {

        $this->contentType->getView($this->listDiv);

        $this->file->label = 'File';
        $this->file->multiUpload = true;

        return parent::getContent();

    }


    protected function loadUpdateForm()
    {

    }


    protected function onSubmit()
    {

        $this->contentType->saveType();

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new FileContentType();
            $type->parentId = $this->contentType->getContentId();
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }


    }

}