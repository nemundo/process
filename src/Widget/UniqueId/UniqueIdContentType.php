<?php


namespace Nemundo\Process\Widget\UniqueId;


use Nemundo\Process\Content\Type\AbstractTreeContentType;

class UniqueIdContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {

        $this->typeLabel = 'Unique Id Widget';
        $this->typeId = 'd1ffcbeb-0cb2-490d-be7f-85147d4fdbee';
        $this->dataId='088f4aed-77cd-47db-a100-bb888afc8a96';
        $this->viewClass = UniqueIdContentView::class;

    }

}