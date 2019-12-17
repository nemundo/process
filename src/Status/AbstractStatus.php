<?php


namespace Nemundo\Process\Status;


use Nemundo\Process\Content\AbstractContentType;


abstract class AbstractStatus extends AbstractContentType
{

    use ProcessStatusTrait;
}