<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImage;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImageReader;

abstract class AbstractImageContentType extends AbstractTreeContentType
{

    /**
     * @var FileRequest
     */
    public $fileRequest;


    public function __construct($dataId = null)
    {

        $this->typeLabel[LanguageCode::EN] = 'Image';
        $this->typeLabel[LanguageCode::DE] = 'Bild';

        //$this->typeId = '8be6b7e8-532c-4138-9f60-0ecd1b498648';

        $this->formClass = ImageContentForm::class;
        $this->viewClass = ImageContentView::class;


        parent::__construct($dataId);
    }



/*
    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Image';
        $this->typeLabel[LanguageCode::DE] = 'Bild';

        //$this->typeId = '8be6b7e8-532c-4138-9f60-0ecd1b498648';

        $this->formClass = ImageContentForm::class;
        $this->viewClass = ImageContentView::class;


    }*/


    protected function onCreate()
    {

        $data = new TemplateImage();
        $data->image->fromFileRequest($this->fileRequest);
        $this->dataId = $data->save();

    }


    public function getDataRow()
    {

        return (new TemplateImageReader())->getRowById($this->dataId);

    }


    public function getSubject()
    {
        return $this->getDataRow()->image->getFilename();
    }

}