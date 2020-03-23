<?php


namespace Nemundo\Process\App\Share\Content;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\User\Com\ListBox\UserListBox;

class ShareContentForm extends AbstractContentForm
{

    /**
     * @var ShareContentType
     */
    public $contentType;

    /**
     * @var UserListBox
     */
    private $to;

    /**
     * @var BootstrapLargeTextBox
     */
    private $message;

    public function getContent()
    {

        $this->to = new UserListBox($this);
        $this->to->validation = true;

        $this->message = new BootstrapLargeTextBox($this);
        $this->message->label = 'Nachricht';

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $this->contentType->toId = $this->to->getValue();
        $this->contentType->message = $this->message->getValue();
        $this->contentType->saveType();

    }

}