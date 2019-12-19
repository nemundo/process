<?php


namespace Nemundo\Process\App\News\Com;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\App\News\Data\News\NewsReader;
use Nemundo\Process\Content\View\AbstractContentView;

class NewsContentView extends AbstractContentView
{

    public function getContent()
    {

        $row = (new NewsReader())->getRowById($this->dataId);

        $subtitle = new AdminSubtitle($this);
        $subtitle->content=$row->title;

        $p = new Paragraph($this);
        $p->content = $row->teaser;

        return parent::getContent();

    }

}