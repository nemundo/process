<?php


namespace Nemundo\Process\Template\Content\Video;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;


abstract class AbstractVideoContentForm extends AbstractFileContentForm
{

    protected function loadContainer()
    {
        parent::loadContainer();
        $this->file->acceptFileType = AcceptFileType::VIDEO;
    }

}