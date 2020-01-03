<?php


namespace Nemundo\Process\App\Wiki\Content;


use App\App\IssueTracker\Workflow\Process\IssueTrackerProcess;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Type\AbstractMenuContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\ToDo\Workflow\Process\ToDoProcess;

class WikiPageContentType extends AbstractMenuContentType
{

    //use MenuTrait;

    protected function loadContentType()
    {

        $this->contentId = 'b94ec710-d1bd-4430-8866-4a7f9a493c52';
        $this->contentLabel = 'Wiki Page';
        $this->formClass = WikiPageContentForm::class;
        $this->listClass = WikiPageContentList::class;
        //$this->itemClass=WikiPageContentItem::class;

        $this->viewSite = WikiSite::$site;
        $this->parameterClass = WikiParameter::class;


       /* $this->addMenuClass(LargeTextContentType::class);
        $this->addMenuClass(ToDoProcess::class);
        $this->addMenuClass(IssueTrackerProcess::class);
        /*$this->addMenuClass(EventContentType::class);
        $this->addMenuClass(SurveyContentType::class);*/


    }


    /*
    protected function saveData()
    {



        // TODO: Implement saveData() method.
    }

*/

    public function getSubject()
    {

        $wikiRow = (new WikiReader())->getRowById($this->dataId);
        $subject = $wikiRow->title;

        return $subject;

    }

}