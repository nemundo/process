<?php

namespace Nemundo\Process\Cms\ClassDesigner;


use Nemundo\App\ClassDesigner\Builder\AbstractClassBuilder;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Dev\Code\PhpClass;
use Nemundo\Dev\Code\PhpFunction;
use Nemundo\Dev\Code\PhpVariable;
use Nemundo\Dev\Code\PhpVisibility;

class CmsTypeClassBuilder extends AbstractClassBuilder
{

    public function buildClass()
    {

        $parameterName = (new Text($this->className))->changeToLowercase()->getValue();
        $namespace = $this->namespace . '\Cms\\' . $this->className;

        $typeClassName = $this->className . 'CmsType';

        $phpClass = new PhpClass();
        $phpClass->project = $this->project;
        $phpClass->className = $typeClassName;
        $phpClass->extendsFromClass = 'AbstractTreeContentType';
        $phpClass->namespace = $namespace;
        $phpClass->addUseClass('Nemundo\Process\Content\Type\AbstractTreeContentType');

        $function = new PhpFunction($phpClass);
        $function->visibility = PhpVisibility::ProtectedVariable;
        $function->functionName = 'loadContentType()';
        $function->add('$this->typeLabel = \'' . $this->className . '\';');
        $function->add('$this->typeId = \'' . (new UniqueId())->getUniqueId() . '\';');
        $function->add('$this->formClass = ' . $this->className . 'CmsForm::class;');
        $function->add('$this->viewClass = ' . $this->className . 'CmsView::class;');


        $function = new PhpFunction($phpClass);
        $function->visibility = PhpVisibility::ProtectedVariable;
        $function->functionName = 'onCreate()';

        $function = new PhpFunction($phpClass);
        $function->visibility = PhpVisibility::ProtectedVariable;
        $function->functionName = 'onUpdate()';

        $function = new PhpFunction($phpClass);
        $function->visibility = PhpVisibility::ProtectedVariable;
        $function->functionName = 'onDataRow()';

        $function=new PhpFunction($phpClass);
        $function->functionName='getDataRow()';
        $function->returnDataType='\Nemundo\Model\Row\AbstractModelDataRow';
        $function->add('return parent::getDataRow(); ');





        $phpClass->saveFile();


        $contentTypeVariable = new PhpVariable();
        $contentTypeVariable->variableName = 'contentType';
        $contentTypeVariable->dataType = $typeClassName;


        $phpClass = new PhpClass();
        $phpClass->project = $this->project;
        $phpClass->className = $this->className . 'CmsForm';
        $phpClass->extendsFromClass = 'AbstractContentForm';
        $phpClass->namespace = $namespace;
        $phpClass->addUseClass('Nemundo\Process\Content\Form\AbstractContentForm');
        $phpClass->addVariable($contentTypeVariable);

        $function = new PhpFunction($phpClass);
        $function->functionName = 'getContent()';
        $function->add('return parent::getContent();');

        $function = new PhpFunction($phpClass);
        $function->functionName = 'onSubmit()';
        $function->add('$this->contentType->saveType();');


        $phpClass->saveFile();

        $phpClass = new PhpClass();
        $phpClass->project = $this->project;
        $phpClass->className = $this->className . 'CmsView';
        $phpClass->extendsFromClass = 'AbstractContentView';
        $phpClass->namespace = $namespace;  //$this->namespace . '\Cms';
        $phpClass->addUseClass('Nemundo\Process\Content\View\AbstractContentView');
        $phpClass->addVariable($contentTypeVariable);

        $function = new PhpFunction($phpClass);
        $function->functionName = 'getContent()';
        $function->add('return parent::getContent();');

        $phpClass->saveFile();


    }

}