<?php


namespace Nemundo\Process\Site;


use Nemundo\Process\App\Calendar\Site\CalendarSite;
use Nemundo\Process\App\Document\Site\DocumentSite;
use Nemundo\Process\App\Explorer\Site\ExplorerSite;
use Nemundo\Process\App\Favorite\Site\FavoriteSite;
use Nemundo\Process\App\Inbox\Site\InboxSite;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Site\ContentSite;
use Nemundo\Process\Content\Site\ContentTypeSite;
use Nemundo\Process\Content\Site\TreeSite;
use Nemundo\Process\Geo\Site\GeoSite;
use Nemundo\Process\Group\Site\GroupSite;
use Nemundo\Process\Search\Site\SearchLogSite;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Process\Template\Site\ProcessTemplateSite;
use Nemundo\Process\Workflow\Site\AssignmentSite;
use Nemundo\Process\Workflow\Site\WorkflowInboxSite;
use Nemundo\Process\Workflow\Site\WorkflowSite;
use Nemundo\ToDo\Site\ToDoSite;
use Nemundo\Web\Site\AbstractSite;


class ProcessSite extends AbstractSite
{

    /**
     * @var ProcessSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Process';
        $this->url = 'process';

        ProcessSite::$site = $this;

        //new DocumentSite($this);
        new ContentTypeSite($this);
        new ContentSite($this);
        new TreeSite($this);
        new WorkflowSite($this);
        new WorkflowInboxSite($this);

        //new InboxSite($this);

        new WikiSite($this);
        new ProcessTemplateSite($this);

        new ToDoSite($this);
        new SearchSite($this);
        new FavoriteSite($this);
        new GroupSite($this);


new GeoSite($this);
new CalendarSite($this);

new AssignmentSite($this);
new ExplorerSite($this);

new SearchLogSite($this);
new DocumentSite($this);

new ProcessTemplateSite($this);

    }


    public function loadContent()
    {

    }

}