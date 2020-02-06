<?php


namespace Nemundo\Process\Widget\UniqueId;


use Nemundo\Process\Content\Type\AbstractTreeContentType;

class UniqueIdContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {

        $this->typeLabel = 'Unique Id';
        $this->typeId='d1ffcbeb-0cb2-490d-be7f-85147d4fdbee';
        $this->viewClass=UniqueIdContentView::class;

    }

}