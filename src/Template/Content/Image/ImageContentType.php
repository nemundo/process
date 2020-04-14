<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Core\Language\LanguageCode;

class ImageContentType extends AbstractImageContentType
{

    /**
     * @var FileRequest
     */
    //public $fileRequest;


    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Image';
        $this->typeLabel[LanguageCode::DE] = 'Bild';

        $this->typeId = '8be6b7e8-532c-4138-9f60-0ecd1b498648';

    }

}