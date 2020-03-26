<?php


namespace Nemundo\Process\App\Notification\Category;


use Nemundo\Core\Language\LanguageCode;

class InformationCategory extends AbstractCategory
{

    protected function loadCategory()
    {
        $this->id = 0;
        $this->category[LanguageCode::EN] = 'Information';
        $this->category[LanguageCode::DE] = 'Info';
    }

}