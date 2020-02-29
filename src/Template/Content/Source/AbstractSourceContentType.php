<?php


namespace Nemundo\Process\Template\Content\Source;


use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLogReader;

abstract class AbstractSourceContentType extends AbstractTreeContentType
{


    public function getDataRow()
    {

        $reader = new SourceLogReader();
        $reader->model->loadSource();
        $reader->model->source->loadContentType();
        return $reader->getRowById($this->dataId);
    }


    protected function getHyperlinkContent()
    {

        $hyerplink = new SiteHyperlink();
        $hyerplink->site = $this->getDataRow()->source->getContentType()->getSubjectViewSite();
        return $hyerplink->getContent();

    }

}