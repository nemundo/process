<?php

namespace Nemundo\Process\Workflow\Content\Form;

use Nemundo\Process\Content\Form\AbstractContentForm;


// AbstractProcessStatusForm
// AbstractWorkflowStatusForm
abstract class AbstractStatusForm extends AbstractContentForm
{

    use StatusFormTrait;


    protected function loadContainer()
    {

        parent::loadContainer();
        $this->submitButton->label = 'Weiter';

    }

}