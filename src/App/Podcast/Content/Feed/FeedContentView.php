<?php


namespace Nemundo\Process\App\Podcast\Content\Feed;


use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;

class FeedContentView extends AbstractContentView
{

    /**
     * @var FeedContentType
     */
    public $contentType;

    public function getContent()
    {

        $feedRow = $this->contentType->getDataRow();


        $p=new Paragraph($this);
        $p->content = $feedRow->rssUrl;




        return parent::getContent();

    }

}