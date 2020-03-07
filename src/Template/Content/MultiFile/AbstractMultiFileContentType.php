<?php


namespace Nemundo\Process\Template\Content\MultiFile;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;

abstract class AbstractMultiFileContentType extends AbstractTreeContentType
{

    public function __construct($dataId = null)
    {

        $this->formClass=MultiFileContentForm::class;
        $this->viewClass=MultiFileContentView::class;

        parent::__construct($dataId);
    }

/*
    protected function onCreate()
    {



    }*/


    public function addFileRequest(FileRequest $fileRequest) {

        $data = new TemplateMultiFile();
        $data->active=true;
        $data->dataContentId = $this->getContentId();
        $data->file->fromFileRequest($fileRequest);
        $data->save();

    }


    public function addFilename($filename) {

        $data = new TemplateMultiFile();
        $data->active=true;
        $data->dataContentId = $this->getContentId();
        $data->file->fromFilename($filename);
        $data->save();

    }


}