<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\LargeText\AbstractLargeTextContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Data\LargeText\LargeTextUpdate;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;




class HtmlContentType extends AbstractLargeTextContentType
{

    //use UserRestrictionTrait;
    use ProcessStatusTrait;

    public $html;

    protected function loadContentType()
    {
        $this->typeLabel = 'Html';
        $this->typeId = 'e1daa5be-9302-4126-b85b-a79623a3c86c';

        $this->formClass = HtmlContentForm::class;
        $this->viewClass = HtmlContentView::class;

    }


    public function saveType()
    {
        $this->largeText = $this->html;
        parent::saveType();
    }

}