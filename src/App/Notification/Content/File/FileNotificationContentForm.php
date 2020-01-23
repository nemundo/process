<?php


namespace Nemundo\Process\App\Notification\Content\File;


use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\User\Com\ListBox\UserListBox;

class FileNotificationContentForm extends AbstractContentForm
{


    /**
     * @var UserListBox
     */
    private $to;

    /**
     * @var BootstrapLargeTextBox
     */
    private $message;

    /**
     * @var BootstrapFileUpload
     */
    private $file;

    public function getContent()
    {

        $this->to=new UserListBox($this);
        $this->to->label='To';
        $this->to->validation=true;

        $this->message=new BootstrapLargeTextBox($this);
        $this->message->label='Message';

$this->file=new BootstrapFileUpload($this);
$this->file->label='File';

        $this->to->emptyValueAsDefault=false;
        $this->message->value = '123123123';


        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        $parent=new FileContentType();
        $parent->fileRequest = $this->file->getFileRequest();
        $parent->saveType();

        $type=new FileNotificationContentType();
        $type->parentId=$parent->getContentId();
        $type->userToId=$this->to->getValue();
        $type->message = $this->message->getValue();
        $type->saveType();

        // TODO: Implement onSubmit() method.
    }

}