<?php


namespace Nemundo\Process\Template\Application;


use Nemundo\App\Application\Type\AbstractApplication;
use Nemundo\Process\Template\Data\TemplateCollection;

class TemplateApplication extends AbstractApplication
{

    protected function loadApplication()
    {

        $this->application = 'Template';
        $this->applicationId = '8890096a-5a53-4d6c-ac49-fa17f455f7ad';
        $this->modelCollectionClass = TemplateCollection::class;

    }

}