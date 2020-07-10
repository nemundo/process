<?php

namespace Nemundo\Process\Cms\ClassDesigner;


use Nemundo\App\ClassDesigner\Builder\UsergroupClassBuilder;
use Nemundo\App\ClassDesigner\Com\Form\AbstractClassDesignerForm;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;

class CmsTypeClassBuilderForm extends AbstractClassDesignerForm
{

    /**
     * @var BootstrapTextBox
     */
    private $cmsType;


    protected function loadContainer()
    {
        $this->formTitle = 'Cms Type';
    }

    public function getContent()
    {

        $this->cmsType = new BootstrapTextBox($this);
        $this->cmsType->label = 'Cms Type';
        $this->cmsType->validation = true;

        return parent::getContent();

    }

    protected function onSubmit()
    {



        $builder =new CmsTypeClassBuilder();  // new UsergroupClassBuilder();
        $builder->project = $this->project;
        $builder->className = $this->cmsType->getValue();
        $builder->namespace = $this->app->namespace;
        $builder->buildClass();


    }

}