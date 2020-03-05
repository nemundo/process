<?php


namespace Nemundo\Process\App\Task\Install;


use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexDelete;
use Nemundo\Project\Install\AbstractClean;

class TaskIndexClean extends AbstractClean
{

    public function cleanData()
    {

        (new TaskIndexDelete())->delete();

    }

}