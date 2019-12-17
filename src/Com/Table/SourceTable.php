<?php


namespace Nemundo\Process\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Item\ContentItem;

class SourceTable extends AdminTable
{

    /**
     * @var string
     */
    public $workflowId;

    public function getContent()
    {

        $header = new TableHeader($this);
        $header->addText('Quelle');

        $contentReader = new ContentReader();
        $contentReader->filter->andEqual($contentReader->model->dataId,$this->workflowId);
        $contentReader->filter->andNotEqual($contentReader->model->parentId,'');

        foreach ($contentReader->getData() as $contentRow) {

            $row = new TableRow($this);
            //$row->addText('parentid'.$contentRow->parentId);

            $parentReader = new ContentReader();
            $parentReader->model->loadContentType();
            $parentReader->filter->andEqual($parentReader->model->dataId, $contentRow->parentId);
            $contentType = $parentReader->getRow()->contentType->getContentType();

            //$row->addText($contentType->getClassName());

            $row->addSite($contentType->getViewSite($contentRow->parentId));

        }

        return parent::getContent();

    }

}