<?php


namespace Nemundo\Process\Template\Content\ImageList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\Image\AbstractImageContentForm;
use Nemundo\Process\Template\Content\MultiFile\AbstractMultiFileContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileReader;
use Nemundo\Process\Template\Data\TemplateMultiImage\TemplateMultiImageReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\MultiFileDeleteSite;

abstract class AbstractImageListContentForm extends AbstractContentForm
{

    /**
     * @var AbstractImageListContentType
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

        $contentId =$this->getContentId();

        $reader = new TemplateMultiImageReader();  // new TemplateMultiFileReader();
        $reader->filter->andEqual($reader->model->dataContentId, $contentId);

        $header = new TableHeader($this->table);
        $header->addText('Filename');
        $header->addEmpty();

        foreach ($reader->getData() as $fileRow) {

            $row = new TableRow($this->table);
            $row->strikeThrough = !$fileRow->active;

            if ($fileRow->active) {

                $link = new UrlHyperlink($row);
                $link->url = $fileRow->image->getUrl();
                $link->content = $fileRow->image->getFilename();

                $site = clone(MultiFileDeleteSite::$site);
                $site->addParameter(new FileParameter($fileRow->id));
                $row->addIconSite($site);
            } else {
                $row->addText( $fileRow->image->getFilename());
                $row->addEmpty();
            }

        }


        $this->file->label = 'Image';
        $this->file->multiUpload = true;
        $this->file->acceptFileType=AcceptFileType::IMAGE;

        return parent::getContent();


    }


    protected function loadUpdateForm()
    {

        //return $this->contentType->getContentId();

    }


    protected function getContentId() {

        return $this->contentType->getContentId();

    }


    protected function onSubmit()
    {

        $this->contentType->parentId = $this->parentId;
        $this->contentType->saveType();

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {
            $this->contentType->addFileRequest($fileRequest);

            /*$data = new TemplateMultiFile();
            $data->active=true;
            $data->dataContentId =$contentId;  // $this->getContentId();
            $data->file->fromFileRequest($fileRequest);
            $data->save();*/

        }


    }

}