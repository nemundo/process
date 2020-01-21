<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Process\App\Assignment\Data\Assignment\Assignment;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentDelete;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentReader;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentUpdate;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\ClosedAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;

trait AssignmentTrait
{


    //public $message;

    public $groupId;

    /**
     * @var Date
     */
    public $deadline;

    //  abstract public function getMessage();

    public function __construct($dataId = null)
    {

        $this->typeLabel = 'Group Assignment';
        $this->deadline = new Date();

        parent::__construct($dataId);
    }


    protected function onCreate()
    {

        $this->assignAssignment();

    }


    protected function onDelete()
    {

        (new AssignmentDelete())->deleteById($this->dataId);

    }


    protected function assignAssignment()
    {

        $data = new Assignment();
        $data->statusId = (new OpenAssignmentStatus())->id;
        $data->groupId = $this->groupId;
        $data->deadline = $this->deadline;
        $data->sourceId = $this->parentId;
        $data->message = $this->getMessage();
        $data->contentId = $this->getContentId();
        $this->dataId = $data->save();



        // send email


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

        $assignmentRow =$this->getDataRow();
        $subject = 'Group Assignment to : ' . $assignmentRow->group->group . ' (' . $assignmentRow->status->status . ')';

        if ($assignmentRow->statusId == (new CancelAssignmentStatus())->id) {
            $strike = new Strike();
            $strike->content = $subject;

            $subject = $strike->getContent();
        }

        return $subject;

    }


}