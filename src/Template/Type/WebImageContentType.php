<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\View\WebImageContentView;

class WebImageContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->id = '585ec68c-831a-4a80-8dbb-f82bdb6832b3';
        $this->viewClass = WebImageContentView::class;
//        $this->formClass = ContentForm::class;
    }

}