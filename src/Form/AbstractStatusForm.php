<?php

namespace Nemundo\Process\Form;

use Nemundo\Admin\Com\Form\AbstractAdminEditForm;
use Nemundo\Admin\Com\Form\AbstractAdminForm;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapForm;

use Nemundo\Process\Builder\StatusLogBuilder;
use Nemundo\Process\Status\AbstractStatus;

// AbstractProcessStatusForm
abstract class AbstractStatusForm extends AbstractContentForm  // ContenForAbstractAdminEditForm
{

    //use StatusFormTrait;

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->submitButton->label = 'Weiter';

    }


    protected function loadUpdateForm()
    {
    }


    protected function saveWorkflowLog()
    {

        $workflowBuilder = new StatusLogBuilder($this->parentId);
        $workflowBuilder->contentType = $this->contentType;
        $workflowBuilder->parentId = $this->parentId;
        $workflowBuilder->dataId = $this->dataId;

        $workflowBuilder->saveItem();

    }



    /*
    protected function onUpdate()
    {
    }

    protected function onSave()
    {
        $this->saveWorkflowLog();
    }*/


}