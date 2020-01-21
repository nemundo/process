<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class HtmlContentType extends AbstractTreeContentType
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
        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $data = new LargeText();
        $data->largeText = $this->html;
        $this->dataId = $data->save();

    }

}