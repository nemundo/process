<?php


namespace Nemundo\Process\App\Message\Content;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Group\Com\ListBox\GroupListBox;

class MessageContentForm extends AbstractContentForm
{

    /**
     * @var GroupListBox
     */
    public $to;

    /**
     * @var BootstrapTextBox
     */
    public $subject;

    /**
     * @var BootstrapLargeTextBox
     */
    public $message;


    public function getContent()
    {

        $this->to = new GroupListBox($this);

        $this->subject = new BootstrapTextBox($this);
        $this->subject->label = 'Subject';
        $this->subject->validation = true;

        $this->message = new BootstrapLargeTextBox($this);
        $this->message->label = 'Message';


        $this->to->emptyValueAsDefault = false;
        $this->subject->value = 'subject test';

        $this->message->value = 'bla bla bla';


        return parent::getContent();
    }


    protected function onSubmit()
    {

        $type = new MessageContentType();
        $type->groupToId = $this->to->getValue();
        $type->subject = $this->subject->getValue();
        $type->message = $this->message->getValue();
        $type->saveType();

    }

}