<?php


namespace Nemundo\Process\Template\View;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;
use Nemundo\Process\View\AbstractContentView;
use Nemundo\Process\View\AbstractStatusView;

class LargeTextContentView extends AbstractContentView
{

    public function getContent()
    {

        //(new Debug())->write($this->dataId);

        $row = (new LargeTextReader())->getRowById($this->dataId);

        $p = new Paragraph($this);
        $p->content = (new Html($row->largeText))->getValue();

        return parent::getContent();

    }

}