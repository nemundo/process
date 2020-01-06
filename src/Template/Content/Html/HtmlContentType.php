<?php


namespace Nemundo\Process\Template\Content\Html;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;
use Nemundo\User\Access\UserRestrictionTrait;

class HtmlContentType extends AbstractTreeContentType
{

    //use UserRestrictionTrait;
    use ProcessStatusTrait;

    public $html;

    protected function loadContentType()
    {
        $this->contentLabel = 'Html';
        $this->contentId = 'e1daa5be-9302-4126-b85b-a79623a3c86c';

        $this->formClass = HtmlContentForm::class;
        $this->viewClass = HtmlContentView::class;
        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        // getDataId (if null then createUniqueId)

        $data = new LargeText();
        $data->updateOnDuplicate=true;
        $data->id = $this->dataId;
        $data->largeText = $this->html;
        $data->save();

    }

}