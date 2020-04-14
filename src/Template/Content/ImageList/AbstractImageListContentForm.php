<?php


namespace Nemundo\Process\Template\Content\ImageList;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\Image\ImageContentType;
use Nemundo\Process\Template\Data\TemplateImageIndex\TemplateImageIndexReader;
use Nemundo\Process\Template\Parameter\ImageParameter;
use Nemundo\Process\Template\Site\Image\ImageInactiveSite;

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

        $contentId = $this->contentType->getContentId();

        $reader = new TemplateImageIndexReader();
        $reader->model->loadContent();
        $reader->filter->andEqual($reader->model->parentId, $contentId);

        $header = new TableHeader($this->table);
        $header->addText('Image');
        $header->addEmpty();

        foreach ($reader->getData() as $fileRow) {


            $row = new TableRow($this->table);

            $img = new BootstrapResponsiveImage($row);
            $img->src = $fileRow->urlSmall;

            //$row->addText($fileRow->urlSmall);


            $site = clone(ImageInactiveSite::$site);
            $site->addParameter(new ImageParameter($fileRow->content->dataId));
            $row->addIconSite($site);


            /*
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
            }*/

        }

        $this->file->label = 'Image';
        $this->file->multiUpload = true;
        $this->file->acceptFileType = AcceptFileType::IMAGE;

        return parent::getContent();


    }


    protected function loadUpdateForm()
    {

    }


    protected function onSubmit()
    {

        $this->contentType->saveType();

        foreach ($this->file->getMultiFileRequest() as $fileRequest) {

            $type = new ImageContentType();
            $type->parentId = $this->contentType->getContentId();
            $type->image->fromFileRequest($fileRequest);
            //$type->fileRequest = $fileRequest;
            $type->saveType();

        }

    }

}