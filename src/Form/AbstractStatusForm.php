<?php

namespace Nemundo\Process\Form;

use Nemundo\Admin\Com\Form\AbstractAdminEditForm;
use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapForm;

use Nemundo\Process\Status\AbstractStatus;

// AbstractProcessStatusForm
abstract class AbstractStatusForm extends AbstractAdminForm
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