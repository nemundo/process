<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentForm;

class MessageAssignmentContentForm extends AbstractAssignmentContentForm
{

    /**
     * @var BootstrapLargeTextBox
     */
    private $message;

    public function getContent()
    {

        $this->message=new BootstrapLargeTextBox($this);
        $this->message->label='Message';

        return parent::getContent();
    }

    protected function onSubmit()
    {

        $type=new MessageAssignmentContentType();
        $type->parentId=$this->parentId;
        $type->groupId=$this->group->getValue();
        $type->deadline->fromGermanFormat($this->deadline->getValue());
        $type->message=$this->message->getValue();
        $type->saveType();

    }

}