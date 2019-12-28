<?php

namespace Nemundo\Process\Geo\Site;

use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Geo\Data\Geo\GeoPaginationReader;
use Nemundo\Web\Site\AbstractSite;

class GeoSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Geo';
        $this->url = 'geo';
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $table = new AdminTable($page);

        $externalModel = new ContentModel();
        $externalModel->loadContentType();

        $geoReader = new GeoPaginationReader();

        $join = new ModelJoin($geoReader);
        $join->type = $geoReader->model->id;
        $join->externalModel = $externalModel;
        $join->externalType = $externalModel->id;

        $geoReader->addFieldByModel($externalModel);
        $geoReader->checkExternal($externalModel);

        foreach ($geoReader->getData() as $geoRow) {

            $row = new TableRow($table);
            $row->addText($geoRow->coordinate->getText());
            $row->addText($geoRow->getModelValue($externalModel->subject));

            $row->addText($geoRow->getModelValue($externalModel->contentType->contentType));


        }

        $pagination=new BootstrapPagination($page);
        $pagination->paginationReader = $geoReader;

        $page->render();


    }
}