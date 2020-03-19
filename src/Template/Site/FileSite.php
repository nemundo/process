<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\App\Content\Com\Table\ContentLogTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Com\Form\AddContentForm;

use Nemundo\Process\Content\Com\Table\SourceTable;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileActiveContentType;
use Nemundo\Process\Template\Content\File\FileUploadForm;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFilePaginationReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\Image\ImageInactiveSite;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class FileSite extends AbstractSite
{

    /**
     * @var FileSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'File Template';
        $this->url = 'file-template';
        // TODO: Implement loadSite() method.
        FileSite::$site = $this;

        new FileItemSite($this);
        new PdfExtractSite($this);
        new FileDeleteSite($this);
        new FileActiveSite($this);

        new ImageInactiveSite($this);



    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);

        $form = new FileUploadForm($layout->col1);
        $form->redirectSite = FileSite::$site;

        // search form
        // source

        $fileReader = new TemplateFilePaginationReader();
        $fileReader->model->loadContent();
        $fileReader->model->content->loadContentType();
        $fileReader->model->content->loadUser();
        $fileReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


        // Virtual
        // dataId und content type !!!!

        /*
        $contentModel  = new ContentModel();
        $contentModel->loadUser();
        $contentModel->loadContentType();

        $join=new ModelJoin($fileReader);
        $join->externalModel=$contentModel;
        $join->externalType=$contentModel->dataId;
        $join->type =$fileReader->model->id;

        $treeModel  = new TreeModel();
        $join=new ModelJoin($fileReader);
        $join->externalModel=$treeModel;
        $join->externalType=$treeModel->childId;
        $join->type = $contentModel->id;


        $fileReader->checkExternal($contentModel);
        $fileReader->addFieldByModel($contentModel);*/

        $table = new AdminClickableTable($layout->col1);

        $header = new TableHeader($table);

        $header->addText('File');
        $header->addText('Extension');
        $header->addText('Size');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addText('Source');
        $header->addEmpty();

        foreach ($fileReader->getData() as $fileRow) {

            $row = new BootstrapClickableTableRow($table);

            if (!$fileRow->active) {
                $row->strikeThrough = true;
            }

            $row->addText($fileRow->file->getFilename());
            $row->addText($fileRow->file->getFileExtension());
            $row->addText($fileRow->file->getFileSize());
            $row->addText($fileRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($fileRow->content->user->displayName);
            $row->addText($fileRow->content->contentType->contentType);

            $ul = new UnorderedList($row);
            foreach ($fileRow->content->getContentType()->getParentContent() as $contentRow) {
                $ul->addText($contentRow->subject);
            }

            $site = clone(FileSite::$site);
            $site->addParameter(new FileParameter($fileRow->id));
            $row->addClickableSite($site);


            /* $row->addText($templateFileRow->getModelValue($contentModel->dateTime));
             $row->addText($templateFileRow->getModelValue($contentModel->user->displayName));


             $row->addText($templateFileRow->getModelValue($contentModel->contentType->contentType));*/

            //$contentType =


        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $fileReader;


        $fileParameter = new FileParameter();
        if ($fileParameter->exists()) {

            $fileType = $fileParameter->getContentType();

            $title = new AdminTitle($layout->col2);
            $title->content = $fileType->getSubject();

            $table = new AdminLabelValueTable($layout->col2);
            $table->addLabelValue('Subject', $fileType->getSubject());
            $table->addLabelYesNoValue('Has Parent', $fileType->hasParent());
            $table->addLabelValue('Child Count', $fileType->getChildCount());
            $table->addLabelValue('Parent Count', $fileType->getParentCount());



            $btn = new AdminSiteButton($layout->col2);
            $btn->site = clone(PdfExtractSite::$site);
            $btn->site->addParameter(new FileParameter());

            $btn = new AdminSiteButton($layout->col2);
            $btn->site = clone(FileInactiveSite::$site);
            $btn->site->addParameter(new FileParameter());
            $btn->site->addParameter(new ParentParameter($fileType->getContentId()));

            $btn = new AdminSiteButton($layout->col2);
            $btn->site = clone(FileActiveSite::$site);
            $btn->site->addParameter(new FileParameter());
           // $btn->site->addParameter(new ParentParameter($fileType->getContentId()));



            $btn = new AdminSiteButton($layout->col2);
            $btn->site = clone(FileDeleteSite::$site);
            $btn->site->addParameter(new FileParameter());

            $log =new ContentLogTable($layout->col2);
            $log->contentType = $fileType;


            $fileType->getView($layout->col2);


            $table = new SourceTable($layout->col2);
            $table->contentType = $fileType;

            $form = new AddContentForm($layout->col2);
            $form->contentType = $fileType;
            $form->redirectSite = new Site();


        }


        $page->render();


    }

}