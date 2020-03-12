<?php


namespace Nemundo\Process\Template\Content\Url;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\Text\AbstractTextContentType;

class UrlContentType extends AbstractUrlContentType
{

    public $url;

    protected function loadContentType()
    {

        $this->typeLabel='Url';
        $this->typeId='bffc3e3f-7a32-4d56-821d-aaf5a2a0c8b5';

        $this->viewClass=UrlContentView::class;

    }


    protected function onCreate()
    {
        $this->text = $this->url;
        parent::onCreate();
    }

}