<?php

namespace Nemundo\Process\Template\Status\WorkflowRestore;

use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

class WorkflowRestoreStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->typeLabel = 'Restore';
        $this->typeLabel = 'Wiederherstellen';


        $this->typeId = '6eac78fb-d183-42b2-86b7-dc3298ed71f4';
        $this->closeWorkflow = true;
    }

    protected function onCreate()
    {

        $process = $this->getParentProcess();
        //$process->cancelAssignment();

        $update = new WorkflowUpdate();
        $update->active = true;
        $update->updateById($process->getWorkflowId());

    }

    public function getSubject()
    {
        $subject[LanguageCode::EN] = 'Workflow was restored';
        $subject[LanguageCode::DE] = 'Workflow wurde wiederhergestellt';

        return (new Translation())->getText($subject);

    }


}