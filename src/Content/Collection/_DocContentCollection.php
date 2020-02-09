<?php


namespace Nemundo\Process\Content\Collection;


use App\App\IssueTracker\Workflow\Process\IssueTrackerProcess;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\Content\Type\AbstractContentTypeCollection;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Srf\Content\Livestream\SrfLivestreamContentType;
use Nemundo\SwissPost\Content\PolitischeGemeindeContentType;
use Nemundo\ToDo\Workflow\Process\ToDoProcess;

class DocContentCollection extends AbstractContentTypeCollection
{


    protected function loadCollection()
    {
     $this->addContentType(new WikiPageContentType());
     $this->addContentType(new PolitischeGemeindeContentType());
     $this->addContentType(new SrfLivestreamContentType());
     $this->addContentType(new IssueTrackerProcess());
     $this->addContentType(new ToDoProcess());
     $this->addContentType(new EventContentType());
        // TODO: Implement loadCollection() method.
    }

}