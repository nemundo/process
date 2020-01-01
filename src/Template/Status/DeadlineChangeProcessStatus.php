<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeReader;
use Nemundo\Process\Template\Form\DeadlineChangeForm;
use Nemundo\Process\Template\Item\DeadlineChangeItem;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class DeadlineChangeProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->type[LanguageCode::EN] = 'Deadline Change';
        $this->type[LanguageCode::DE] = 'Termverschiebung';
        $this->contentId = 'cd3ade01-3ef1-452f-8a45-dce792547220';
        $this->changeStatus = false;

        $this->formClass = DeadlineChangeForm::class;
        $this->itemClass=DeadlineChangeItem::class;

    }

    /*
    public function getSubject($dataId)
    {

        $deadlineRow = (new DeadlineChangeReader())->getRowById($dataId);
        $subject = 'Neues Datum für Fertigstellung: ' . $deadlineRow->deadline->getShortDateLeadingZeroFormat();

        return $subject;

    }*/

}