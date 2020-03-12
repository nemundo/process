<?php


namespace Nemundo\Process\Template\Content\Date;


use Nemundo\Html\Inline\Span;
use Nemundo\Process\Content\View\AbstractContentView;

class DateContentView extends AbstractContentView
{

    /**
     * @var AbstractDateContentType
     */
    public $contentType;

    public function getContent()
    {

        $dateRow = $this->contentType->getDataRow();

        $span = new Span($this);
        $span->content = $dateRow->date->getShortDateLeadingZeroFormat();

        return parent::getContent();

    }

}