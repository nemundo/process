<?php


namespace Nemundo\Process\Template\Content\ImageList;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;
use Nemundo\Process\Template\Data\TemplateMultiImage\TemplateMultiImage;

abstract class AbstractImageListContentType extends AbstractTreeContentType
{

    public function __construct($dataId = null)
    {

        $this->formClass=ImageListContentForm::class;
        $this->viewClass=ImageListContentView::class;

        parent::__construct($dataId);
    }

/*
    protected function onCreate()
    {



    }*/


    public function addFileRequest(FileRequest $fileRequest) {

        $data = new TemplateMultiImage();  // TemplateMultiFile();
        $data->active=true;
        $data->dataContentId = $this->getContentId();
        $data->image->fromFileRequest($fileRequest);
        $data->save();

    }


}