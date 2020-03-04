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

abstract class AbstractLargeTextStore extends AbstractType
{


    public $largeText;


    protected $defaultValue;


    abstract protected function loadStore();

    public function __construct()
    {
        parent::__construct();


        $this->viewClass=LargeTextContentView::class;
        $this->formClass=LargeTextContentForm::class;


        $this->loadStore();
    }


    protected function onCreate()
    {

        $data=new LargeText();
        $data->updateOnDuplicate=true;
        $data->id=$this->dataId;
        $data->largeText=$this->largeText;
        $data->save();

    }



}