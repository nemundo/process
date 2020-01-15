<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;


class FileContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {

        $this->typeId = 'bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
        $this->typeLabel = 'File';
        $this->formClass = FileContentForm::class;
        $this->viewClass = FileContentView::class;

    }


    protected function onCreate()
    {
       $this->createMode=true;
    }


    public function fromFilename($filename) {

    }

    public function fromFileRequest() {

    }


    public function getDataRow()
    {
        $documentRow = (new TemplateFileReader())->getRowById($this->dataId);
        return $documentRow;
    }

    public function getSubject()
    {

        $fileRow = $this->getDataRow();
        $subject = $fileRow->file->getFilename();

        return $subject;

    }

}