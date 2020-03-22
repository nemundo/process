<?php


namespace Nemundo\Process\App\Task\Content;


use Nemundo\Process\App\Dashboard\Type\WidgetContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class TaskWidgetContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {

        $this->typeLabel='Task Widget';
        $this->typeId='842ce622-51e4-4af1-93cb-e0e7a393b3b0';
        $this->dataId='981107eb-dcc1-4068-a563-3f9047a60619';

        $this->viewClass=TaskWidgetContentView::class;

        // TODO: Implement loadContentType() method.
    }

}