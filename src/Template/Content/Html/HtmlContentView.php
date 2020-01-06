<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;

class HtmlContentView extends AbstractContentView
{

    public function getContent()
    {

        $div = new Div($this);

        $largeTextRow = (new LargeTextReader())->getRowById($this->dataId);
        $div->content = $largeTextRow->largeText;

        return parent::getContent();

    }

}