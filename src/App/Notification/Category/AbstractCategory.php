<?php


namespace Nemundo\Process\App\Notification\Category;


use Nemundo\Core\Base\AbstractBase;

abstract class AbstractCategory extends AbstractBase
{

    public $id;

    public $category;

    abstract protected function loadCategory();

    public function __construct()
    {
        $this->loadCategory();
    }


}