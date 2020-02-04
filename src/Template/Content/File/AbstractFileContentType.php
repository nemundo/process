<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\File\UniqueFilename;
use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\FileItemSite;
use Nemundo\Project\Path\TmpPath;


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
        $this->viewSite = FileItemSite::$site;
        $this->listClass=FileContentList::class;
        $this->parameterClass = FileParameter::class;
        parent::__construct($dataId);
    }


    protected function onCreate()
    {


        // check for video


        $data = new TemplateFile();
        $data->active = true;

        if ($this->fileRequest !== null) {
            $data->file->fromFileRequest($this->fileRequest);
        }

        if ($this->filename !== null) {
            $data->file->fromFilename($this->filename);
        }

        $data->contentId = $this->getContentId();
        $this->dataId = $data->save();


        $fileRow = $this->getDataRow();


        // text file
        // office document

        if ($fileRow->file->getFileExtension() == 'pdf') {

            $filenameInput = $fileRow->file->getFullFilename();
            $filenameOutput = (new TmpPath())
                ->addPath((new UniqueFilename())->getUniqueFilename('txt'))
                ->getFilename();

            //(new Debug())->write($fileRow->file->getFullFilename());

            //$command = "pdftotext $filenameInput $filenameOutput";
            $command = "pdftotext $filenameInput -";

            //(new Debug())->write($command);

            $output = shell_exec($command);

            if ($output !== null) {
                $update = new TemplateFileUpdate();
                $update->text = $output;
                $update->updateById($this->dataId);
            }

            //(new Debug())->write($output);

            //$reader = new TextFileReader();


        }


    }


    protected function onSearchIndex()
    {

        $fileRow = $this->getDataRow();
        $this->addSearchWord($fileRow->file->getFilename());
        $this->addSearchText($fileRow->text);

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