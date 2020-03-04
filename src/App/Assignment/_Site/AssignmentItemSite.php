<?php


namespace Nemundo\Process\App\Assignment\Site;


use App\App\IssueTracker\Workflow\Process\IssueTrackerProcess;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Survey\Content\Survey\SurveyContentType;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Web\Site\AbstractSite;

class AssignmentItemSite extends AbstractSite
{

    /**
     * @var AssignmentItemSite
     */
    public static $site;

    protected function loadSite()
    {
   $this->url='assignment-item';
   $this->menuActive=false;

   AssignmentItemSite::$site=$this;

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $contentParameter = new ContentParameter();
        $contentParameter->addAllowedContentType(new SurveyContentType());
        $contentParameter->addAllowedContentType(new IssueTrackerProcess());
        $contentType = $contentParameter->getContentType();

        // check allowed


        $contentType->getView($page);

        $page->render();

        // TODO: Implement loadContent() method.
    }

}