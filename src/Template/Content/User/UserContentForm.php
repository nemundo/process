<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class UserContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapTextBox
     */
    private $login;

    public function getContent()
    {

        $this->login= new BootstrapTextBox($this);
        $this->login->label = 'eMail';
        $this->login->validation=true;

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        $type  = new UserContentType($this->dataId);
        $type->login = $this->login->getValue();
        $type->email = $this->login->getValue();
        $type->saveType();


    }

}