<?php


namespace Nemundo\Process\Template\Content\MultiFile;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;

class MultiFileContentForm extends AbstractMultiFileContentForm
{

    /**
     * @var BootstrapFileUpload
     */
   // private $file;

    /*
    public function getContent()
    {

        $this->file = new BootstrapFileUpload($this);
        $this->file->label = 'File';
        $this->file->multiUpload = true;

        return parent::getContent();
    }


    protected function onSubmit()
    {

        $type = new MultiFileContentType();
        $type->parentId = $this->parentId;
//        $type->fileRequest = $fileRequest;
        $type->saveType();



        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type->addFileRequest($fileRequest);

            /*
            $type = new FileContentType();
            $type->parentId = $this->parentId;
            $type->fileRequest = $fileRequest;
            $type->saveType();*/

       // }


    //}

}