<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDeleteReader;

class FileInactiveContentType extends AbstractTreeContentType
{

    //use LogTrait;
    use NotificationTrait;

    public $fileId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'File Delete';
        $this->typeLabel[LanguageCode::DE] = 'Datei löschen';
        $this->typeId = 'a83ea4f8-9605-40d0-9557-bb8224d41e24';

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

        $subject[LanguageCode::EN] = 'File ' . $row->file->file->getFilename() . ' was deleted';
        $subject[LanguageCode::DE] = 'Dokument ' . $row->file->file->getFilename() . ' wurde gelöscht';

        return (new Translation())->getText($subject);

    }


    public function getMessage()
    {

        return $this->getSubject();

        // TODO: Implement getMessage() method.
    }

}