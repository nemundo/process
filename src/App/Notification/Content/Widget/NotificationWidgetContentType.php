<?php


namespace Nemundo\Process\App\Notification\Content\Widget;


use Nemundo\Process\App\Dashboard\Type\WidgetContentType;

class NotificationWidgetContentType extends WidgetContentType
{

    protected function loadContentType()
    {

        parent::loadContentType();
        $this->typeLabel = 'Notification';
        $this->dataId = 'cda065a2-8463-4fc0-8ed4-6a39f2be95a4';

        $this->viewClass = NotificationWidgetContentView::class;

    }

}