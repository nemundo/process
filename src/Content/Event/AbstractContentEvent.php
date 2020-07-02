<?php


namespace Nemundo\Process\Content\Event;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractType;

abstract class AbstractContentEvent extends AbstractBase
{

    public function onCreate(AbstractType $contentType) {

    }


    public function onUpdate(AbstractType $contentType) {

    }

}