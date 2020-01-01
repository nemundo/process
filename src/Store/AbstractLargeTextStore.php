<?php


namespace Nemundo\Process\Store;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Model\Definition\Model\AbstractModel;
use Nemundo\Model\Type\Text\LargeTextType;
use Nemundo\Process\Content\Type\AbstractType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Form\LargeTextContentForm;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\Process\Template\View\LargeTextContentView;

abstract class AbstractLargeTextStore extends AbstractType  // LargeTextContentType
{


    public $largeText;



    protected $defaultValue;


    //public $dataId;

    abstract protected function loadStore();

    public function __construct()
    {
        parent::__construct();


        $this->viewClass=LargeTextContentView::class;
        $this->formClass=LargeTextContentForm::class;


        $this->loadStore();
    }



    public function saveType()
    {

        $data=new LargeText();
        $data->updateOnDuplicate=true;
        $data->id=$this->dataId;
        $data->largeText=$this->largeText;
        $data->save();

    }


    /*

    protected function loadStore() {

    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        $form = parent::getForm($parent);
        $form->dataId=$this->dataId;

        return $form;

    }


    public function getView(AbstractHtmlContainer $parent)
    {

        $view =parent::getView($parent);
        $view->dataId = $this->dataId;

        return $view;


    }*/


}