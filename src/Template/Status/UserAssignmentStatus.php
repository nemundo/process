<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogReader;
use Nemundo\Process\Template\Form\UserAssignmentForm;
use Nemundo\Process\View\StatusView;

class UserAssignmentStatus extends AbstractStatus
{

    protected function loadContentType()
    {

        //parent::loadContentType();

        $this->label = 'Assignment (User)';
        $this->id = '3ca6ccea-7eb0-4a5c-945c-9c0da28e0cc1';
        $this->formClass = UserAssignmentForm::class;
        $this->viewClass=StatusView::class;
        $this->changeStatus = false;

    }


    public function getSubject($dataId)
    {

        $reader = new UserAssignmentLogReader();
        $reader->model->loadUser();
        $row = $reader->getRowById($dataId);
        $text = 'Assign to ' . $row->user->displayName;

       // $text='';
        return $text;

    }

}