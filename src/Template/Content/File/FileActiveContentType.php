<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDeleteReader;

class FileActiveContentType extends AbstractTreeContentType
{

    public $fileId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'File Restore';
        $this->typeLabel[LanguageCode::DE] = 'Datei Wiederherstellen';
        $this->typeId = '77734321-006f-404b-9bee-2960ebb8d0c2';

    }


    protected function onCreate()
    {

        $update = new TemplateFileUpdate();
        $update->active = true;
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

        $subject[LanguageCode::EN] = 'File ' . $row->file->file->getFilename() . ' was restored';
        $subject[LanguageCode::DE] = 'Dokument ' . $row->file->file->getFilename() . ' wurde wiederherstellt';

        return (new Translation())->getText($subject);

    }


}