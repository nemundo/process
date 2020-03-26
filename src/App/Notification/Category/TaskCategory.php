<?php


namespace Nemundo\Process\App\Notification\Category;


use Nemundo\Core\Language\LanguageCode;

class TaskCategory extends AbstractCategory
{

    protected function loadCategory()
    {
        $this->id = 1;
        $this->category[LanguageCode::EN] = 'Task';
        $this->category[LanguageCode::DE] = 'Aufgabe';
    }

}