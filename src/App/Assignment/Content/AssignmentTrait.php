<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Assignment\Data\Assignment\Assignment;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentDelete;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentReader;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentUpdate;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\ClosedAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
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


    /*
        protected function loadContentType()
        {
            $this->typeLabel = 'Group Assignment';
            $this->deadline = new Date();
        }*/


    protected function onCreate()
    {

        //$this->assignAssignment();
$this->saveAssignment();

    }


    protected function onFinished() {

        /** @var AbstractTreeContentType $parentContentType */
        $parentContentType = $this->getParentContentType();


        // send email
//        foreach ($this->assignment->getUserIdListFromIdentificationId() as $userId) {


        $this->group = new GroupContentType();
        $this->group->fromGroupId($this->groupId);

        foreach ($this->group->getUserIdList() as $userId) {

            $mail = new ResponsiveActionMailMessage();
            $mail->mailTo = (new UserContentType($userId))->getDataRow()->email;
            $mail->subject = 'Aufgabe: ' . $parentContentType->getSubject();  // . $contentType->getSubject();
//            $mail->actionText = (new Html($this->message))->getValue();
            $mail->actionText = $parentContentType->getView()->getContent(); //(new Html($this->message))->getValue();


            $mail->actionLabel = 'Ansehen';
            $mail->actionUrlSite = $parentContentType->getViewSite();
            $mail->sendMail();

        }

    }



    protected function onDelete()
    {

        (new AssignmentDelete())->deleteById($this->dataId);

    }


    protected function saveAssignment()
    {

        $data = new Assignment();
        $data->statusId = (new OpenAssignmentStatus())->id;
        $data->groupId = $this->groupId;
        $data->deadline = $this->deadline;
        $data->sourceId = $this->parentId;
        $data->message = $this->getMessage();
        $data->contentId = $this->getContentId();
        $this->dataId = $data->save();





    }


    protected function cancelAssignment()
    {

        $update = new AssignmentUpdate();
        $update->statusId = (new CancelAssignmentStatus())->id;
        $update->filter->andEqual($update->model->sourceId, $this->parentId);
        $update->update();

    }


    protected function closeAssignment()
    {

        $update = new AssignmentUpdate();
        $update->statusId = (new ClosedAssignmentStatus())->id;
        $update->filter->andEqual($update->model->sourceId, $this->parentId);
        $update->update();

    }


    public function getDataRow()
    {

        $reader = new AssignmentReader();
        $reader->model->loadGroup();
        $reader->model->loadStatus();
        $assignmentRow = $reader->getRowById($this->dataId);

        return $assignmentRow;

    }


    public function getSubject()
    {

        /*
        $reader = new AssignmentReader();
        $reader->model->loadGroup();
        $reader->model->loadStatus();
        $assignmentRow = $reader->getRowById($this->dataId);*/

        $assignmentRow = $this->getDataRow();
        $subject = 'Group Assignment to : ' . $assignmentRow->group->group . ' (' . $assignmentRow->status->status . ')';

        if ($assignmentRow->statusId == (new CancelAssignmentStatus())->id) {
            $strike = new Strike();
            $strike->content = $subject;

            $subject = $strike->getContent();
        }

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