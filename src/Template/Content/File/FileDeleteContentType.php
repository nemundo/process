<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDeleteReader;

class FileDeleteContentType extends AbstractTreeContentType  // AbstractProcessStatus
{

    public $fileId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Document Delete';
        $this->typeLabel[LanguageCode::DE] = 'Dokument löschen';
        $this->typeId = 'a83ea4f8-9605-40d0-9557-bb8224d41e24';
        //$this->changeStatus=false;

    }


    protected function onCreate()
    {

        $update = new TemplateFileUpdate();
        $update->active = false;
        $update->updateById($this->fileId);

        $data = new TemplateFileDelete();
        $data->fileId = $this->fileId;
        $this->dataId = $data->save();

    }


    public function getSubject()
    {

        $reader = new TemplateFileDeleteReader();
        $reader->model->loadFile();
        $row = $reader->getRowById($this->dataId);

 $subject = 'File ' . $row->file->file->getFilename() . ' was deleted';

        return $subject;

    }


}