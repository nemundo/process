<?php


namespace Nemundo\Process\Site;


use Nemundo\Process\App\Calendar\Site\CalendarSite;
use Nemundo\Process\App\Dashboard\Site\DashboardSite;
use Nemundo\Process\App\Document\Site\DocumentSite;
use Nemundo\Process\App\Favorite\Site\UserFavoriteSite;
use Nemundo\Process\App\Feed\Site\FeedSite;
use Nemundo\Process\App\Inbox\Site\InboxSite;
use Nemundo\Process\App\Notification\Site\NotificationAdminSite;
use Nemundo\Process\App\Notification\Site\UserNotificationInboxSite;
use Nemundo\Process\App\Notification\Site\UserNotificationSite;
use Nemundo\Process\App\Task\Site\TaskIndexSite;
use Nemundo\Process\App\Task\Site\TaskSite;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Site\ContentLogSite;
use Nemundo\Process\Content\Site\ContentSite;
use Nemundo\Process\Content\Site\TreeSite;
use Nemundo\Process\Geo\Site\GeoSite;
use Nemundo\Process\Group\Site\GroupSite;
use Nemundo\Process\Group\Site\UserGroupSite;
use Nemundo\Process\Search\Site\SearchLogSite;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Process\Search\Site\SearchWordSite;
use Nemundo\Process\Template\Site\File\FileSearchSite;
use Nemundo\Process\Template\Site\File\FileSite;
use Nemundo\Process\Template\Site\Image\ImageIndexSite;
use Nemundo\Process\Template\Site\Image\ImageSite;
use Nemundo\Process\Template\Site\ProcessTemplateSite;
use Nemundo\Process\Template\Site\UserSite;
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

        //ProcessSite::$site = $this;


        //new ContentTypeSite($this);
        new ContentSite($this);
        //new TreeSite($this);

        new WikiSite($this);
        new FeedSite($this);


        new ProcessTemplateSite($this);

        //new ToDoSite($this);
        new SearchSite($this);
        new SearchWordSite($this);
        new UserFavoriteSite($this);
        new GroupSite($this);
        new UserGroupSite($this);


        new GeoSite($this);
        new CalendarSite($this);
        new InboxSite($this);



        //new ExplorerSite($this);

        new SearchLogSite($this);
        new ContentLogSite($this);
        new DocumentSite($this);

        new ProcessTemplateSite($this);
        new FileSite($this);
        new FileSearchSite($this);

        new ImageSite($this);
        new ImageIndexSite($this);

        //new MessageSite($this);

        //new AssignmentSite($this);
        //new AssignmentIndexSite($this);


        new UserNotificationSite($this);
        new UserNotificationInboxSite($this);
        new NotificationAdminSite($this);

        new DashboardSite($this);

        new UserSite($this);


        new TaskSite($this);
        new TaskIndexSite($this);


    }


    public function loadContent()
    {

    }

}