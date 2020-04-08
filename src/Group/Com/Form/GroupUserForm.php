<?php


namespace Nemundo\Process\Group\Com\Form;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
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

        $this->user = new UserListBox($this);
        $this->user->submitOnChange = true;

        $this->submitButton->visible = false;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $this->groupId;
        $data->userId = $this->user->getValue();
        $data->save();

    }

}