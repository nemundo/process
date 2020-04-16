<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Type\File\File;
use Nemundo\Model\Data\Property\File\FileProperty;
use Nemundo\Model\Parameter\FilenameParameter;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileRedirectConfig;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFile;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileDelete;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileUpdate;
use Nemundo\Process\Template\Data\TemplateWebFile\TemplateWebFile;


abstract class AbstractWebFileContentType extends AbstractTreeContentType
{

    use NotificationTrait;

    /**
     * @var FileProperty
     */
    public $file;

    public function __construct($dataId = null)
    {

        $this->typeLabel = 'Web File';

        /*$this->formClass = FileContentForm::class;
        $this->viewClass = FileContentView::class;
        $this->viewSite = TemplateFileRedirectConfig::$redirectTemplateFileFileSite;
        $this->listClass = FileContentList::class;
        $this->parameterClass = FilenameParameter::class;*/
        parent::__construct($dataId);

        $this->file = new FileProperty();

    }


    protected function onCreate()
    {

        $data = new TemplateWebFile();
        $data->file->fromFileProperty($this->file);
        $this->dataId = $data->save();

    }

}