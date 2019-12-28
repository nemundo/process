<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\SurveyContentForm;
use Nemundo\Process\Content\Type\AbstractMenuContentType;

class SurveyContentType extends AbstractMenuContentType
{

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.

        $this->id='b6757597-14a7-49a3-bf2c-8869917216a6';
        $this->type = 'Survey';
        $this->formClass = SurveyContentForm::class;

        $this->nextMenuClass = OptionTextContentType::class;




    }

}