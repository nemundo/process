<?php


namespace Nemundo\Process\Site;


use Nemundo\Process\App\Assignment\Site\AssignmentIndexSite;
use Nemundo\Process\App\Assignment\Site\AssignmentSite;
use Nemundo\Process\App\Calendar\Site\CalendarSite;
use Nemundo\Process\App\Dashboard\Site\DashboardSite;
use Nemundo\Process\App\Document\Site\DocumentSite;
use Nemundo\Process\App\Explorer\Site\ExplorerSite;
use Nemundo\Process\App\Favorite\Site\FavoriteSite;
use Nemundo\Process\App\Message\Site\MessageSite;
use Nemundo\Process\App\Notification\Site\NotificationSite;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Site\ContentLogSite;
use Nemundo\Process\Content\Site\ContentSite;
use Nemundo\Process\Content\Site\ContentTypeSite;
use Nemundo\Process\Content\Site\TreeSite;
use Nemundo\Process\Geo\Site\GeoSite;
use Nemundo\Process\Group\Site\GroupSite;
use Nemundo\Process\Group\Site\UserGroupSite;
use Nemundo\Process\Search\Site\SearchLogSite;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Process\Search\Site\SearchWordSite;
use Nemundo\Process\Template\Site\ChildRemoveSite;
use Nemundo\Process\Template\Site\FileSite;
use Nemundo\Process\Template\Site\ProcessTemplateSite;
use Nemundo\Process\Template\Site\UserSite;
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

        new ContentTypeSite($this);
        new ContentSite($this);
        new TreeSite($this);

        new WikiSite($this);
        new ProcessTemplateSite($this);

        new ToDoSite($this);
        new SearchSite($this);
        new SearchWordSite($this);
        new FavoriteSite($this);
        new GroupSite($this);
        new UserGroupSite($this);


        new GeoSite($this);
        new CalendarSite($this);


        new ExplorerSite($this);

        new SearchLogSite($this);
        new ContentLogSite($this);
        new DocumentSite($this);

        new ProcessTemplateSite($this);
        new FileSite($this);

        new MessageSite($this);

        new AssignmentSite($this);
        new AssignmentIndexSite($this);


        new NotificationSite($this);

        new DashboardSite($this);

        new UserSite($this);


        new ChildRemoveSite($this);

    }


    public function loadContent()
    {

    }

}