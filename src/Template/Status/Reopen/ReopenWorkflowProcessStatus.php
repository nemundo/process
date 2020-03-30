<?php


namespace Nemundo\Process\Template\Status\Reopen;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class ReopenWorkflowProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN]='Reopen';
        $this->typeLabel[LanguageCode::DE]='Wiedereröffnung';
        $this->typeId='b983dbd1-70cc-427f-b8e1-b38035ba9524';

        // soll im Menü dargestellt werden
        //$this->changeStatus=true;

    }


    protected function onCreate()
    {

        $this->getParentProcess()->reopenWorkflow();

    }


    public function isStatusChangeable()
    {
        return true;
    }

    public function getMessage()
    {

        $message = 'Wiedereröffnung';
        return $message;

    }

}