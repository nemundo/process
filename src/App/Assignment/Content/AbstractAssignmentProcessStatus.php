<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLog;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogDelete;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogReader;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogRow;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

abstract class AbstractAssignmentProcessStatus extends AbstractProcessStatus
{

    public $groupId;


    protected function onDelete()
    {

        (new AssignmentLogDelete())->deleteById($this->dataId);

    }


    protected function onCreate()
    {

        parent::onCreate();

        $data = new AssignmentLog();
        $data->assignmentId = $this->groupId;
        $this->dataId = $data->save();

        $process = $this->getParentProcess();
        $process->changeAssignment($this->groupId);


    }


    protected function onDataRow()
    {

        $reader = new AssignmentLogReader();
        $reader->model->loadAssignment();
        $this->dataRow = $reader->getRowById($this->dataId);

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|AssignmentLogRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
    }


    public function getMessage()
    {

        $assignmentRow = $this->getDataRow();
        $subject[LanguageCode::EN] = 'Group Assignment to : ' . $assignmentRow->assignment->group;
        $subject[LanguageCode::DE] = 'Zuweisung an ' . $assignmentRow->assignment->group;

        return (new Translation())->getText($subject);

    }

}