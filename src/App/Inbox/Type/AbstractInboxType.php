<?php


namespace Nemundo\Process\App\Inbox\Type;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Html\Container\AbstractHtmlContainer;

abstract class AbstractInboxType extends AbstractBase
{

    public $id;

    public $title;

    public $containerClass;

    abstract protected function loadType();


    public function __construct()
    {
        $this->loadType();
    }

}