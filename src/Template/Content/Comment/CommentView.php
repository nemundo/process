<?php


namespace Nemundo\Process\Template\Content\Comment;


use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;

class CommentView extends AbstractContentView
{

    public function getContent()
    {

        $row = $this->contentType->getDataRow();

        $p = new Paragraph($this);
        $p->content = (new Html($row->largeText))->getValue();

        return parent::getContent();

    }

}