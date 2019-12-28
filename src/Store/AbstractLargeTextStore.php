<?php


namespace Nemundo\Process\Store;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Model\Definition\Model\AbstractModel;
use Nemundo\Model\Type\Text\LargeTextType;
use Nemundo\Process\Template\Type\LargeTextContentType;

class AbstractLargeTextStore extends LargeTextContentType
{

    public $dataId;


    public function __construct()
    {
        parent::__construct();
        $this->loadStore();
    }


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


    }


}