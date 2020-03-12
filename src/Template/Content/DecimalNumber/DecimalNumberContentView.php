<?php


namespace Nemundo\Process\Template\Content\DecimalNumber;


use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;

class DecimalNumberContentView extends AbstractContentView
{

    /**
     * @var AbstractDecimalNumberContentType
     */
    public $contentType;

    public function getContent()
    {

        $dataRow = $this->contentType->getDataRow();

        $div = new Div($this);
        $div->content = $dataRow->decimalNumber;

        return parent::getContent();

    }

}