<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;


abstract class AbstractFileContentType extends AbstractTreeContentType
{

    /**
     * @var FileRequest
     */
    public $fileRequest;

    /**
     * @var string
     */
    public $filename;

    public function __construct($dataId = null)
    {
        $this->typeLabel = 'File';
        $this->formClass = FileContentForm::class;
        $this->viewClass = FileContentView::class;
        parent::__construct($dataId);
    }



    protected function onCreate()
    {

        //(new Debug())->write($this->getContentId());

        //$this->createMode = true;

        $data = new TemplateFile();
        $data->active = true;
        //$data->file->fromFileRequest($this->fileRequest);


        if ($this->fileRequest !== null) {
            $data->file->fromFileRequest($this->fileRequest);
        }

        if ($this->filename !== null) {
            $data->file->fromFilename($this->filename);
        }

        $data->contentId = $this->getContentId();

        $this->dataId = $data->save();

    }


    protected function onDelete()
    {
        (new TemplateFileDelete())->deleteById($this->dataId);
    }


    /*
    public function fromFilename($filename)
    {

        $data = new TemplateFile();
        $data->active = true;
        $data->file->fromFilename($filename);
        $this->dataId = $data->save();

        $this->saveType();

    }

    public function fromFileRequest(FileRequest $fileRequest)
    {

        $data = new TemplateFile();
        $data->active = true;
        $data->file->fromFileRequest($fileRequest);
        $this->dataId = $data->save();

        //$this->createMode=true;

        //$this->saveType();

    }*/


    public function getDataRow()
    {
        $fileRow = (new TemplateFileReader())->getRowById($this->dataId);
        $this->contentId = $fileRow->contentId;
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