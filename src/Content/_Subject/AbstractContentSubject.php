<?php


namespace Nemundo\Process\Content\Subject;


use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\Content\Type\AbstractDataId;

abstract class AbstractContentSubject extends AbstractDataId
{

    abstract public function getSubject();

}