<?php

namespace Nemundo\Process\Form;

use Nemundo\Process\Builder\StatusLogBuilder;
use Nemundo\Process\Content\Item\ContentItem;


// AbstractProcessStatusForm
abstract class AbstractStatusForm extends AbstractContentForm
{

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



        $workflowBuilder = new ContentItem();  // StatusLogBuilder();
        $workflowBuilder->contentType = $this->contentType;
        $workflowBuilder->parentId = $this->parentId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveItem();

    }


}