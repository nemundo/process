<?php


namespace Nemundo\Process\App\Video\Content\Vimeo;


use Nemundo\Process\Content\Form\AbstractContentForm;

class VimeoContentForm extends AbstractContentForm
{

    /**
     * @var VimeoContentType
     */
    public $contentType;

    protected function onSubmit()
    {

        $this->contentType->saveType();

    }

}