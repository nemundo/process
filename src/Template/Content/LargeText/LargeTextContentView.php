<?php


namespace Nemundo\Process\Template\Content\LargeText;


use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;

class LargeTextContentView extends AbstractContentView
{

    /**
     * @var LargeTextContentType
     */
    public $contentType;

    public function getContent()
    {

        $largeTextRow = $this->contentType->getDataRow();

        $p = new Div($this);
        $p->content = (new Html($largeTextRow->largeText))->getValue();

        return parent::getContent();

    }

}