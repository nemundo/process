<?php


namespace Nemundo\Process\App\Survey\Content\Type;


use Nemundo\Process\App\Survey\Content\Form\SurveyContentContainer;
use Nemundo\Process\App\Survey\Content\Form\SurveyErfassungContentForm;
use Nemundo\Process\Content\Type\AbstractMenuContentType;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;

class SurveyContentType extends AbstractSequenceContentType
{

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.

        $this->id='b6757597-14a7-49a3-bf2c-8869917216a6';
        $this->type = 'Survey';
        $this->formClass = SurveyContentContainer::class;

        $this->startContentType = new ErfassungContentType();  //  ErfassungContentType::class;




    }

}