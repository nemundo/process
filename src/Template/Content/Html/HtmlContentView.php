<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;

class HtmlContentView extends AbstractContentView
{

    public function getContent()
    {

        $largeTextRow = $this->contentType->getDataRow();

        $div = new Div($this);
        $div->content = $largeTextRow->largeText;

        return parent::getContent();

    }

}