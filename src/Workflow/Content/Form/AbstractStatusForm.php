<?php

namespace Nemundo\Process\Workflow\Content\Form;

use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;


// AbstractProcessStatusForm
// AbstractWorkflowStatusForm
abstract class AbstractStatusForm extends AbstractContentForm
{

    //use StatusFormTrait;

    /**
     * @var AbstractProcessStatus
     */
    public $contentType;

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->submitButton->label = 'Weiter';

    }

}