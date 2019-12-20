<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Form\LargeTextContentForm;
use Nemundo\Process\Template\View\LargeTextContentView;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;


class LargeTextContentType extends AbstractContentType
{

    use ProcessStatusTrait;

    //public $label;

    protected function loadContentType()
    {
       $this->id = '1b4e6652-8f85-4cd8-b44a-1f50afb696ac';
       $this->formClass=LargeTextContentForm::class;
       $this->viewClass= LargeTextContentView::class;

       //$this->label='Large Text';
        $this->label = 'LARGE TEXT';


    }

}