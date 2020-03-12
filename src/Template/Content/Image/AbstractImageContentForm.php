<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;

abstract class AbstractImageContentForm extends AbstractFileContentForm
{

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->file->acceptFileType = AcceptFileType::IMAGE;

    }

}