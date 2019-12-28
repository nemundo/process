<?php


namespace Nemundo\Process\Template\View;


use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\LargeText\LargeTextReader;

class LargeTextContentView extends AbstractContentView
{

    public function getContent()
    {

        //$row = (new LargeTextReader())->getRowById($this->dataId);


        $reader = new LargeTextReader();
        $reader->filter->andEqual($reader->model->id, $this->dataId);
        foreach ($reader->getData() as $row) {
            $p = new Paragraph($this);
            $p->content = (new Html($row->largeText))->getValue();
        }

        return parent::getContent();

    }

}