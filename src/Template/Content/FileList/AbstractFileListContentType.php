<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;

abstract class AbstractFileListContentType extends AbstractTreeContentType
{

    public function __construct($dataId = null)
    {

        $this->formClass= FileListContentForm::class;  // MultiFileContentForm::class;
        $this->viewClass= FileListContentView::class;  // MultiFileContentView::class;

        parent::__construct($dataId);
    }


    protected function onCreate()
    {

        $this->dataId = (new UniqueId())->getUniqueId();


    }



    protected function onUpdate()
    {

    }


    public function existItem()
    {
        return parent::existContent();
    }


    /*
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

    }*/


}