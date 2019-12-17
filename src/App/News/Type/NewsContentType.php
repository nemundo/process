<?php


namespace Nemundo\Process\App\News\Type;


use Nemundo\Process\App\News\Com\NewsContentForm;
use Nemundo\Process\App\News\Com\NewsContentView;
use Nemundo\Process\Content\AbstractContentType;

class NewsContentType extends AbstractContentType
{

    protected function loadContentType()
    {

        $this->id = '4adb432d-f02a-476f-abaf-1eb17390726f';

        $this->viewClass = NewsContentView::class;
        $this->formClass = NewsContentForm::class;

    }

}