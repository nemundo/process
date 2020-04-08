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

        $this->login = new BootstrapTextBox($this);
        $this->login->label = 'eMail';
        $this->login->validation = true;
        $this->login->autofocus = true;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $this->contentType->login = $this->login->getValue();
        $this->contentType->email = $this->login->getValue();
        $this->contentType->saveType();

    }

}