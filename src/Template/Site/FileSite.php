<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Process\Template\Content\File\FileParentContainer;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFilePaginationReader;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Web\Site\AbstractSite;

class FileSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title='File Template';
        $this->url='file-template';
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();


        // search form
        // source

        $fileReader=new TemplateFilePaginationReader();


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
        $fileReader->addFieldByModel($contentModel);

        $table = new AdminTable($page);

        $header=new TableHeader($table);
        $header->addText('Source');


        foreach ($fileReader->getData() as $templateFileRow) {

            $row=new TableRow($table);
            $row->addText($templateFileRow->file->getFilename());

            $row->addText($templateFileRow->getModelValue($contentModel->dateTime));
            $row->addText($templateFileRow->getModelValue($contentModel->user->displayName));


            $row->addText($templateFileRow->getModelValue($contentModel->contentType->contentType));

            //$contentType =


        }

        $pagination=new BootstrapPagination($page);
        $pagination->paginationReader=$fileReader;



        $page->render();

        // TODO: Implement loadContent() method.
    }

}