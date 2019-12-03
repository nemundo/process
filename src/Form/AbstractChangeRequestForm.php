<?php

namespace Nemundo\Process\Form;

use Nemundo\Admin\Com\Form\AbstractAdminEditForm;
use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Schleuniger\App\ChangeRequest\Parameter\StatusParameter;
use Nemundo\Process\Status\AbstractStatus;

abstract class AbstractChangeRequestForm extends AbstractAdminForm
{

    use StatusFormTrait;

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->submitButton->label = 'Weiter';

    }


    protected function loadUpdateForm()
    {
    }

    protected function onUpdate()
    {
    }

    protected function onSave()
    {
    }


}