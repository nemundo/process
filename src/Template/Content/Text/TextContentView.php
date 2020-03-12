<?php


namespace Nemundo\Process\Template\Content\Text;


use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;

class TextContentView extends AbstractContentView
{

    /**
     * @var TextContentType
     */
    public $contentType;

    public function getContent()
    {

        $textRow = $this->contentType->getDataRow();

        $p = new Div($this);
        $p->content = $textRow->text;

        return parent::getContent();

    }

}