<?php

namespace Nemundo\Process\App\Video\Content\Vimeo;


use Nemundo\Process\Content\Type\AbstractTreeContentType;

class VimeoContentType extends AbstractTreeContentType
{

    protected function loadContentType()
    {
        $this->typeLabel = 'Vimeo';
        $this->typeId = 'c72d0d4b-3f76-474a-ba04-5b9139458532';

        $this->viewClass=VimeoContentView::class;

    }

}