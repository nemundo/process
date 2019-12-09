<?php


namespace Nemundo\Process\Template\Form;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Form\AbstractStatusForm;
use Nemundo\Process\Item\WorkflowItem;
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

        return parent::getContent();

    }


    protected function onSave()
    {

        $assignment = new Identification();
        $assignment->setUserIdentification($this->user->getValue());

        $item = new WorkflowItem($this->workflowId);
        $item->changeAssignment($assignment);

    }

}