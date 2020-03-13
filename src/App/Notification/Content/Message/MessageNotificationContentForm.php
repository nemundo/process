<?php


namespace Nemundo\Process\App\Notification\Content\Message;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Random\RandomText;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\User\Type\UserSessionType;

class MessageNotificationContentForm extends AbstractContentForm
{

    /**
     * @var MessageNotificationContentType|AbstractNotificationContentType
     */
    public $contentType;

    /**
     * @var UserListBox
     */
    private $to;

    /**
     * @var BootstrapTextBox
     */
    private $subject;

    /**
     * @var BootstrapLargeTextBox
     */
    private $message;


    public function getContent()
    {

        $this->to = new UserListBox($this);
        $this->to->label = 'To';
        $this->to->validation = true;

        $this->subject=new BootstrapTextBox($this);
        $this->subject->label='Subject';


        $this->message = new BootstrapLargeTextBox($this);
        $this->message->label[LanguageCode::EN] = 'Message';
        $this->message->label[LanguageCode::DE] = 'Nachricht';


        if (ProcessConfig::$debugMode) {
            //$this->to->emptyValueAsDefault = false;
            $this->to->value=(new UserSessionType())->userId;
            $this->subject->value=(new RandomText())->getText();
            $this->message->value = '123123123';
        }

        return parent::getContent();

    }


    protected function onSubmit()
    {

        //$type=new MessageNotificationContentType();
        //$this->contentType->parentId = $this->parentId;
        $this->contentType->toUserId = $this->to->getValue();
        $this->contentType->subject=$this->subject->getValue();
        $this->contentType->message = $this->message->getValue();
        $this->contentType->saveType();


    }

}