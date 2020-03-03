<?php


namespace Nemundo\Process\Template\Content\Url;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Process\Content\View\AbstractContentView;

class UrlContentView extends AbstractContentView
{

    /**
     * @var UrlContentType
     */
    public $contentType;

    public function getContent()
    {

        $urlRow = $this->contentType->getDataRow();

        $link = new UrlHyperlink($this);
        $link->openNewWindow=true;
        $link->url = $urlRow->text;
        $link->content=  $urlRow->text;


        return parent::getContent();
    }

}