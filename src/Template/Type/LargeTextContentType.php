<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Form\LargeTextContentForm;
use Nemundo\Process\Template\View\LargeTextContentView;


class LargeTextContentType extends AbstractTreeContentType
{

    public $largeText;


    protected function loadContentType()
    {

        $this->contentId = '1b4e6652-8f85-4cd8-b44a-1f50afb696ac';
        $this->contentLabel = 'Large Text';

        $this->formClass = LargeTextContentForm::class;
        $this->viewClass = LargeTextContentView::class;


    }


    protected function onCreate()
    {

        $data = new LargeText();
        $data->updateOnDuplicate = true;
        $data->id = $this->getDataId();
       // $this->dataId
        $data->largeText = $this->largeText;
        $data->save();

        $this->addSearchText($this->largeText);

    }

}