<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Form\YoutubeContentForm;
use Nemundo\Process\Template\View\YoutubeContentView;

class YoutubeContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->id = '5badc331-f0d1-4f14-8eba-e8468a64b9e3';
        $this->type='YouTube';
        $this->formClass = YoutubeContentForm::class;
        $this->viewClass = YoutubeContentView::class;
    }

}