<?php


namespace Nemundo\Process\Template\Content\LargeText;


use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;

class LargeTextContentView extends AbstractContentView
{

    /**
     * @var LargeTextContentType
     */
    public $contentType;

    public function getContent()
    {

        //$row = (new LargeTextReader())->getRowById($this->dataId);

        $largeTextRow = $this->contentType->getDataRow();

        $p = new Div($this);  // Paragraph($this);
        $p->content =$largeTextRow->largeText;

        /*
        $reader = new LargeTextReader();
        $reader->filter->andEqual($reader->model->id, $this->dataId);
        foreach ($reader->getData() as $row) {
            $p = new Div($this);  // Paragraph($this);
            $p->content = (new Html($row->largeText))->getValue();
        }*/

        return parent::getContent();

    }

}