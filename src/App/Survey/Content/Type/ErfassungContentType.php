<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\SurveyErfassungContentForm;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractMenuContentType;

class ErfassungContentType extends AbstractMenuContentType
{
    protected function loadContentType()
    {
     $this->id='77390376-d9d2-4538-ac6b-297629531f5c';
     $this->type='Erfassung';
     $this->formClass=SurveyErfassungContentForm::class;
        // TODO: Implement loadContentType() method.
$this->nextMenuClass= OptionTextContentType::class;

    }

}