<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Core\Random\UniqueId;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Form\AbstractStatusForm;
use Nemundo\Process\Item\WorkflowItem;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLog;
use Nemundo\Process\Template\Item\UserAssignmentItem;
use Nemundo\User\Data\User\UserReader;
use Nemundo\Workflow\App\Identification\Model\Identification;

class UserAssignmentForm extends AbstractStatusForm
{

    /**
     * @var BootstrapListBox
     */
    private $user;

    public function getContent()
    {

        $this->user = new BootstrapListBox($this);
        $this->user->label='Mitarbeiter';
        $this->user->validation = true;

        $reader = new UserReader();
        $reader->addOrder($reader->model->displayName);
        foreach ($reader->getData() as $userCustomRow) {
            $this->user->addItem($userCustomRow->id, $userCustomRow->displayName);
        }


        $workflowRow = (new WorkflowReader())->getRowById($this->parentId);
        $this->user->value = $workflowRow->assignment->identificationId;


        return parent::getContent();

    }





    protected function onSubmit()
    {

        $item = new UserAssignmentItem();
        $item->parentId= $this->parentId;
        $item->userId = $this->user->getValue();
        $item->saveItem();

    }

}