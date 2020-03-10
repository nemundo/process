<?php


namespace Nemundo\Process\App\Task\Type;


use Nemundo\Process\App\Task\Index\TaskIndexTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

abstract class AbstractTaskContentType extends AbstractTreeContentType
{

    use TaskIndexTrait;

}