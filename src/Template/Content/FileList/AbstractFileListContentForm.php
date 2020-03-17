<?php


namespace Nemundo\Process\Template\Content\FileList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFile;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\MultiFileDeleteSite;

abstract class AbstractFileListContentForm extends AbstractContentForm
{

    /**
     * @var AbstractFileListContentType
     */
    public $contentType;

    /**
     * @var BootstrapFileUpload
     */
    protected $file;

    /**
     * @var AdminTable
     */
    private $table;


    protected function loadContainer()
    {
        parent::loadContainer();

        $this->table = new AdminTable($this);
        $this->file = new BootstrapFileUpload($this);

    }


    public function getContent()
    {


        $this->contentType->getView($this);



        $this->file->label = 'File';
        $this->file->multiUpload = true;

        return parent::getContent();


    }


    protected function loadUpdateForm()
    {

       //return $this->contentType->getContentId();

    }


    /*
    protected function getContentId() {

       return $this->contentType->getContentId();

    }*/


    protected function onSubmit()
    {

        $this->contentType->saveType();

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new FileContentType();
            $type->parentId = $this->contentType->getContentId();
            $type->fileRequest = $fileRequest;
            $type->saveType();

        }


    }

}