<?php


namespace Nemundo\Process\Form;


use Nemundo\Admin\Com\Form\AbstractAdminForm;

abstract class AbstractContentForm extends AbstractAdminForm
{

    use ContentFormTrait;

    public function getContent()
    {

        if ($this->dataId !== null) {
            $this->loadUpdateForm();
        }

        return parent::getContent();

    }

}