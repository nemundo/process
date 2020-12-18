<?php

namespace Nemundo\Process\Cms\ClassDesigner;


use Nemundo\App\ClassDesigner\Builder\AbstractClassBuilderForm;

class CmsTypeClassBuilderForm extends AbstractClassBuilderForm
{

    protected function loadContainer()
    {
        parent::loadContainer();
        $this->formTitle = 'Cms Type';
    }


    protected function onSubmit()
    {

        $builder = new CmsTypeClassBuilder();
        $builder->project = $this->project;
        $builder->className = $this->className->getValue();
        $builder->namespace = $this->app->namespace;
        $builder->buildClass();

    }

}