<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogReader;
use Nemundo\Process\Template\Form\UserAssignmentForm;
use Nemundo\Process\Template\Item\UserAssignmentItem;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class UserAssignmentProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->type[LanguageCode::EN] = 'Assignment (User)';
        $this->type[LanguageCode::DE] = 'Zuweisung an';
        $this->id = '3ca6ccea-7eb0-4a5c-945c-9c0da28e0cc1';
        $this->formClass = UserAssignmentForm::class;
        $this->itemClass=UserAssignmentItem::class;
        $this->changeStatus = false;

    }




}