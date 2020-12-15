<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\File\FileInformation;
use Nemundo\Core\File\Pdf\PdfFile;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\System\OperatingSystem;
use Nemundo\Core\TextFile\Reader\TextFileReader;
use Nemundo\Core\Type\File\File;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Model\Data\Property\File\FileProperty;
use Nemundo\Model\Parameter\FilenameParameter;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileRedirectConfig;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;


abstract class AbstractFileContentType extends AbstractTreeContentType
{

    use NotificationTrait;

    /**
     * @var FileProperty
     */
    public $file;

    public function __construct($dataId = null)
    {

        $this->typeLabel = 'File';
        $this->formClass = FileContentForm::class;
        $this->viewClass = FileContentView::class;
        $this->viewSite = TemplateFileRedirectConfig::$redirectTemplateFileFileSite;
        $this->listClass = FileContentList::class;
        $this->parameterClass = FilenameParameter::class;
        parent::__construct($dataId);

        $this->file = new FileProperty();

    }


    protected function onCreate()
    {

        $data = new TemplateFile();
        $data->active = true;
        $data->file->fromFileProperty($this->file);
        $this->dataId = $data->save();

    }


    protected function onFinished()
    {

        parent::onFinished();

        $update = new TemplateFileUpdate();
        $update->contentId = $this->getContentId();
        $update->updateById($this->dataId);

    }


    protected function onIndex()
    {

        $templateFileRow = $this->getDataRow();
        $filename = $templateFileRow->file->getFullFilename();
        $file = new FileInformation($filename);

        $text = '';

        if ((new OperatingSystem())->isLinux()) {

            if ($file->isPdf()) {

                $pdfFile = new PdfFile($filename);
                $text = $pdfFile->getPdfText();

            }

        }

        if ($file->isText()) {

            $txtFile = new TextFileReader($filename);
            $text = $txtFile->getText();

        }

        $update = new TemplateFileUpdate();
        $update->text = $text;
        $update->updateById($this->dataId);

        $this->addSearchWord($templateFileRow->file->getFilename());
        $this->addSearchText($text);
        $this->saveSearchIndex();

    }


    protected function onDelete()
    {
        (new TemplateFileDelete())->deleteById($this->dataId);
        $this->deleteSearchIndex();
    }


    public function isActive()
    {
        return $this->getDataRow()->active;
    }


    public function getDataRow()
    {
        $fileRow = (new TemplateFileReader())->getRowById($this->dataId);
        $this->contentId = $fileRow->contentId;
        return $fileRow;
    }


    public function getSubject()
    {

        $fileRow = $this->getDataRow();
        $subject = $fileRow->file->getFilename();

        return $subject;

    }


    public function getMessage()
    {

        $fileRow = $this->getDataRow();

        $hyperlink = new UrlHyperlink();
        $hyperlink->content = $fileRow->file->getFilename();
        $hyperlink->url = $fileRow->file->getUrl();

        $subject[LanguageCode::EN] = 'File ' . $hyperlink->getBodyContent() . ' was uploaded';
        $subject[LanguageCode::DE] = 'Dokument ' . $hyperlink->getBodyContent() . ' wurde hochgeladen';

        return (new Translation())->getText($subject);

    }


    public function getText()
    {
        return $this->getDataRow()->text;
    }


    public function getFilename()
    {
        return $this->getDataRow()->file->getFilename();
    }


    public function getFullFilename()
    {
        return $this->getDataRow()->file->getFullFilename();
    }


    public function getFileExtension()
    {

        $file = new File($this->getDataRow()->file->getFullFilename());
        return $file->getFileExtension();

    }


    // isText


    public function isPdf()
    {

        $value = false;
        if ($this->getFileExtension() === 'pdf') {
            $value = true;
        }

        return $value;

    }


    public function isImage()
    {

    }


    public function isVideo()
    {

    }

}