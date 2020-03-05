<?php


namespace Nemundo\Process\App\Document\Install;


use Nemundo\Process\App\Document\Data\Document\DocumentDelete;
use Nemundo\Project\Install\AbstractClean;

class DocumentIndexClean extends AbstractClean
{

    public function cleanData()
    {

        (new DocumentDelete())->delete();

    }

}