<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLog;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogDelete;
use Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogReader;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\ClosedAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndex;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Template\Content\User\UserContentType;

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


    protected function onFinished() {

        /** @var AbstractTreeContentType $parentContentType */
        $parentContentType = $this->getParentContentType();

        $this->group = new GroupContentType();
        $this->group->fromGroupId($this->groupId);

        foreach ($this->group->getUserIdList() as $userId) {

            $mail = new ResponsiveActionMailMessage();
            $mail->mailTo = (new UserContentType($userId))->getDataRow()->email;
            $mail->subject = 'Aufgabe: ' . $parentContentType->getSubject();
            $mail->actionText = $parentContentType->getView()->getContent();

            $mail->actionLabel = 'Ansehen';
            $mail->actionUrlSite = $parentContentType->getViewSite();
            $mail->sendMail();

        }

    }



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
        $subject = 'Group Assignment to : ' . $assignmentRow->assignment->group;

        return $subject;

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