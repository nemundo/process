<?php


namespace Nemundo\Process\Template\View;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\View\AbstractContentView;
use Nemundo\Process\View\AbstractStatusView;

class DocumentContentView extends AbstractContentView
{

    public function getContent()
    {

        $documentRow = (new DocumentReader())->getRowById($this->dataId);

        $hyperlink = new UrlHyperlink($this);
        $hyperlink->content = $documentRow->document->getFilename();
        $hyperlink->url = $documentRow->document->getUrl();

        return parent::getContent();

    }

}