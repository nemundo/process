<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLog;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogDelete;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogReader;
use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait AssignmentTrait
{


    public $message;

    /**
     * @var AbstractGroupContentType
     */
    public $group;

    public $groupId;

    /**
     * @var Date
     */
    public $deadline;


    protected function onDelete()
    {

        (new AssignmentLogDelete())->deleteById($this->dataId);

    }


    protected function saveAssignment()
    {

        $data = new AssignmentLog();
        $data->assignmentId = $this->groupId;
        $this->dataId = $data->save();

    }


    protected function onDataRow()
    {

        $reader = new AssignmentLogReader();
        $reader->model->loadAssignment();
        $this->dataRow = $reader->getRowById($this->dataId);

    }


    public function getSubject()
    {

        $assignmentRow = $this->getDataRow();
        $subject[LanguageCode::EN] = 'Group Assignment to : ' . $assignmentRow->assignment->group;
        $subject[LanguageCode::DE] = 'Zuweisung an ' . $assignmentRow->assignment->group;

        return (new Translation())->getText($subject);

    }


    public function getMessage()
    {

        $message = 'Assignment';

        if ($this->message !== null) {
            $message = $this->message;
        }

        return $message;

    }

}