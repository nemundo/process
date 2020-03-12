<?php


namespace Nemundo\Process\Template\Content\Number;


use Nemundo\Html\Inline\Span;
use Nemundo\Process\Content\View\AbstractContentView;

class NumberContentView extends AbstractContentView
{
    /**
     * @var AbstractNumberContentType
     */
    public $contentType;

    public function getContent()
    {

        $textRow = $this->contentType->getDataRow();

        $span = new Span($this);
        $span->content = $textRow->number;


        return parent::getContent();

    }

}