<?php


namespace Nemundo\Process\Cms\Page;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Com\Template\AbstractTemplateDocument;
use Nemundo\Process\Cms\Data\CmsType\CmsTypeReader;

class CmsPage extends AbstractTemplateDocument
{

    public function getContent()
    {


        $table = new AdminTable($this);

        $reader = new CmsTypeReader();
        $reader->model->loadParentContentType();
        $reader->model->loadCmsContentType();

        $header = new TableHeader($table);
        $header->addText($reader->model->parentContentType->label);
        $header->addText($reader->model->cmsContentType->label);

        foreach ($reader->getData() as $cmsTypeRow) {

            $row = new TableRow($table);
            $row->addText($cmsTypeRow->parentContentType->contentType);
            $row->addText($cmsTypeRow->cmsContentType->contentType);

        }


        return parent::getContent();

    }

}