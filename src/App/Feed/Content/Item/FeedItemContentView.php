<?php


namespace Nemundo\Process\App\Feed\Content\Item;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\Content\View\AbstractContentView;

class FeedItemContentView extends AbstractContentView
{

    /**
     * @var FeedItemContentType
     */
    public $contentType;

    public function getContent()
    {


        $feedRow = $this->contentType->getDataRow();



        $subtitle = new AdminSubtitle($this);
        $subtitle->content = $feedRow->feed->title;


        $hyperlink=new UrlHyperlink($this);
        $hyperlink->url=$feedRow->url;

        $title=new AdminTitle($hyperlink);
        $title->content=$feedRow->title;

        $p=new Paragraph($this);
        $p->content= $feedRow->description;

            // player



        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}