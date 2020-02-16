<?php


namespace Nemundo\Process\Template\Status\Cancel;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Content\LargeText\LargeTextContentView;
use Nemundo\Process\Template\Data\LargeText\LargeText;

use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class CancelProcessStatus extends AbstractProcessStatus
{

    public $comment;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Cancel';
        $this->typeLabel[LanguageCode::DE] = 'Abbruch';

        $this->typeId = '510c9d20-74cc-43b6-82d3-d6a6df487813';

        $this->changeStatus = true;
        $this->closeWorkflow = true;

        $this->formClass = CancelStatusForm::class;
        $this->viewClass =LargeTextContentView::class;

    }


    protected function onCreate()
    {

        $data = new LargeText();
        $data->largeText = $this->comment;
        $this->dataId = $data->save();


        $this->getParentProcess()->cancelAssignment();


    }

}