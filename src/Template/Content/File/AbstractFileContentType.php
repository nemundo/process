<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;


abstract class AbstractFileContentType extends AbstractTreeContentType
{


    public function __construct($dataId = null)
    {
        $this->typeLabel = 'File';
        $this->formClass = FileContentForm::class;
        $this->viewClass = FileContentView::class;
        parent::__construct($dataId);
    }


    protected function onCreate()
    {
        $this->createMode = true;
    }


    protected function onDelete()
    {
        (new TemplateFileDelete())->deleteById($this->dataId);
    }


    public function fromFilename($filename)
    {

    }

    public function fromFileRequest()
    {

    }


    public function getDataRow()
    {
        $fileRow = (new TemplateFileReader())->getRowById($this->dataId);
        return $fileRow;
    }

    public function getSubject()
    {

        $fileRow = $this->getDataRow();

        $hyperlink = new UrlHyperlink();
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();

        $subject = 'File ' . $hyperlink->getContent() . ' was uploaded';

        return $subject;

    }

}