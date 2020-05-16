<?php


namespace Nemundo\Process\Template\Com\Form;


use Nemundo\Package\Dropzone\DropzoneUploadForm;
use Nemundo\Process\Template\Site\File\FileSaveSite;

class FileContentDropzoneUploadForm extends DropzoneUploadForm
{

    public function getContent()
    {

        $this->saveSite = FileSaveSite::$site;
        return parent::getContent();

    }

}