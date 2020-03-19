<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Dev\Deployment\DeploymentConfig;
use Nemundo\Dev\Deployment\StagingEnvironment;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Model\Parameter\FilenameParameter;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Log\Type\LogTrait;
use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileRedirectConfig;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;


abstract class AbstractFileContentType extends AbstractTreeContentType
{

    use LogTrait;

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
        $this->viewSite = TemplateFileRedirectConfig::$redirectTemplateFileFileSite;
        $this->listClass = FileContentList::class;
        $this->parameterClass = FilenameParameter::class;
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

        $this->dataId = $data->save();

        $fileRow = $this->getDataRow();


        // text file
        // office document

        if (DeploymentConfig::$stagingEnviroment !== StagingEnvironment::DEVELOPMENT) {

            if ($fileRow->file->getFileExtension() == 'pdf') {

                $filenameInput = $fileRow->file->getFullFilename();
                $command = "pdftotext $filenameInput -";
                $output = shell_exec($command);

                if ($output !== null) {
                    $update = new TemplateFileUpdate();
                    $update->text = $output;
                    $update->updateById($this->dataId);
                }


            }


            // Office Doc


        }


    }


    protected function onFinished()
    {

        $update = new TemplateFileUpdate();
        $update->contentId = $this->getContentId();
        $update->updateById($this->dataId);

    }


    protected function onIndex()
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

        $text = $hyperlink->getContent();

        if (!$fileRow->active) {
            //$subject .= ' deleted file';

            $strike = new Strike();
            $strike->content = $hyperlink->getContent();

            $text = $strike->getContent();

        }

        //$text = $hyperlink->getContent();  // . ' wurde hochgeladen';

        return $text;

    }


    public function getLog()
    {

        $fileRow = $this->getDataRow();

        $hyperlink = new UrlHyperlink();
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();

        $subject[LanguageCode::EN] = 'File ' . $hyperlink->getContent() . ' was uploaded';
        $subject[LanguageCode::DE] = 'Dokument ' . $hyperlink->getContent() . ' wurde hochgeladen';

        if (!$fileRow->active) {
            $subject .= ' deleted file';
        }

        return (new Translation())->getText(  $subject);

    }


    public function getText()
    {
        return $this->getDataRow()->text;
    }

}