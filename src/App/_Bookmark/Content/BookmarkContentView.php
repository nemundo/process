<?php


namespace Nemundo\Process\App\Bookmark\Content;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;

class BookmarkContentView extends AbstractContentView
{

    /**
     * @var BookmarkContentType
     */
    public $contentType;

    public function getContent()
    {

        $bookmarkRow = $this->contentType->getDataRow();

        $hyperlink=new UrlHyperlink($this);
        $hyperlink->openNewWindow=true;
        $hyperlink->url = $bookmarkRow->url;
        $hyperlink->content = $bookmarkRow->title;

        $p = new Paragraph($this);
        $p->content = $bookmarkRow->description;

        return parent::getContent();

    }

}