<?php


namespace Nemundo\Process\Template\Content\Event;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Template\Type\DocumentContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;

class EventContentType extends AbstractContentType
{

    use MenuTrait;

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
        $this->type='Event';
        $this->contentId = '6af8dd00-7aa7-4dd4-8906-9d00abcbfe7c';
        $this->viewClass=EventContentView::class;
        $this->itemClass=EventContentItem::class;
        $this->listClass=EventContentList::class;


        // comment
        // image
        //

        $this->addMenuClass(LargeTextContentType::class);
        $this->addMenuClass(DocumentContentType::class);


    }

}