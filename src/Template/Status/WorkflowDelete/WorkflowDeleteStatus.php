<?php

namespace Nemundo\Process\Template\Status\WorkflowDelete;

use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

class WorkflowDeleteStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {
        $this->typeLabel = 'Löschen';
        $this->typeId = 'ed86e502-5296-4e2b-8512-77230d4f4a71';
        $this->closeWorkflow = true;
    }

    protected function onCreate()
    {

        $process = $this->getParentProcess();
        $process->cancelAssignment();

        $update = new WorkflowUpdate();
        $update->active = false;
        $update->updateById($process->getWorkflowId());

    }

    public function getSubject()
    {
        $subject[LanguageCode::EN] = 'Workflow was deleted';
        $subject[LanguageCode::DE] = 'Workflow wurde gelöscht';

        return (new Translation())->getText($subject);

    }


}