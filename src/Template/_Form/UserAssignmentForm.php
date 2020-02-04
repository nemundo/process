<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Template\Status\UserAssignmentProcessStatus;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;
use Nemundo\Process\Template\Item\UserAssignmentItem;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\User\Data\User\UserReader;

class UserAssignmentForm extends AbstractStatusForm
{

    /**
     * @var BootstrapListBox
     */
    private $user;

    public function getContent()
    {

        $this->user = new BootstrapListBox($this);
        $this->user->label = 'User';
        $this->user->validation = true;

        $reader = new UserReader();
        $reader->addOrder($reader->model->displayName);
        foreach ($reader->getData() as $userCustomRow) {
            $this->user->addItem($userCustomRow->id, $userCustomRow->displayName);
        }

        //$workflowRow = (new WorkflowReader())->getRowById($this->parentId);
        //$this->user->value = $workflowRow->assignment->identificationId;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $item = new UserAssignmentProcessStatus();
        $item->parentId = $this->parentId;
        $item->userId = $this->user->getValue();
        $item->saveType();

    }

}