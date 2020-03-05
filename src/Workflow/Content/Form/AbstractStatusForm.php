<?php

namespace Nemundo\Process\Workflow\Content\Form;

use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;


// AbstractProcessStatusForm
// AbstractWorkflowStatusForm
abstract class AbstractStatusForm extends AbstractContentForm
{

    /**
     * @var AbstractProcessStatus
     */
    public $contentType;

    protected function loadContainer()
    {

        parent::loadContainer();
        $this->submitButton->label[LanguageCode::EN] = 'Next';
        $this->submitButton->label[LanguageCode::DE] = 'Weiter';

    }

}