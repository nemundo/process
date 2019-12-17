<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Form\LargeTextContentForm;
use Nemundo\Process\Template\View\LargeTextContentView;


class LargeTextContentType extends AbstractContentType
{

    protected function loadContentType()
    {
       $this->id = '1b4e6652-8f85-4cd8-b44a-1f50afb696ac';
       $this->formClass=LargeTextContentForm::class;
       $this->viewClass= LargeTextContentView::class;

    }

}