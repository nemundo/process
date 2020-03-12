<?php


namespace Nemundo\Process\App\Calendar\Install;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexDelete;
use Nemundo\Project\Install\AbstractClean;

class CalendarIndexClean extends AbstractClean
{

    public function cleanData()
    {

        (new CalendarIndexDelete())->delete();

        // TODO: Implement cleanData() method.
    }

}