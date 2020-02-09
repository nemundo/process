<?php


namespace Nemundo\Process\Group\Com\Form;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\User\Com\ListBox\UserListBox;

class GroupUserForm extends BootstrapForm
{

    public $groupId;

    /**
     * @var UserListBox
     */
    private $user;

    public function getContent()
    {

        $this->user=new UserListBox($this);
        $this->user->submitOnChange=true;

        $this->submitButton->visible=false;

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        $item = new GroupContentType();
        $item->fromGroupId($this->groupId);
        $item->addUser($this->user->getValue());


    }

}