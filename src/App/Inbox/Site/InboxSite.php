<?php


namespace Nemundo\Process\App\Inbox\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\App\Inbox\Parameter\InboxParameter;
use Nemundo\Process\App\Inbox\Type\AbstractInboxType;
use Nemundo\Process\App\Inbox\Type\AufgabeNewType;
use Nemundo\Process\App\Inbox\Type\NotificationInboxType;
use Nemundo\Process\App\Inbox\Type\TaskInboxType;
use Nemundo\Process\App\Notification\Com\Container\UserNotificationContainer;
use Nemundo\Process\App\Task\Com\Container\TaskContainer;
use Nemundo\Web\Site\AbstractSite;

class InboxSite extends AbstractSite
{

    /**
     * @var InboxSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Inbox';
        $this->url = 'inbox';

        InboxSite::$site = $this;

        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);
        $layout->col1->columnWidth = 1;
        $layout->col2->columnWidth = 11;


        /** @var AbstractInboxType[] $list */
        $inboxList = [];
        $inboxList[] = new NotificationInboxType();
        $inboxList[] = new TaskInboxType();
        $inboxList[] = new AufgabeNewType();

        $inboxId = (new InboxParameter())->getValue();

        $list = new BootstrapHyperlinkList($layout->col1);
        $list->addCssClass('position-fixed');

        foreach ($inboxList as $type) {

            $site = clone(InboxSite::$site);
            $site->title = $type->title;
            $site->addParameter(new InboxParameter($type->id));

            if ($inboxId == $type->id) {
                $list->addActiveHyperlink($type->title);

                $className = $type->containerClass;
                $container = new $className($layout->col2);

            } else {
                $list->addSite($site);
            }

        }


        /*
        $site = clone(InboxSite::$site);
        $site->title = 'Notification';
        $site->addParameter(new InboxParameter('notification'));
        $list->addSite($site);

        $site = clone(InboxSite::$site);
        $site->title = 'Task';
        $site->addParameter(new InboxParameter('task'));
        $list->addSite($site);*/

/*
        if ($inboxId == 'notification') {
            new UserNotificationContainer($layout->col2);
        }

        if ($inboxId == 'task') {
            new TaskContainer($layout->col2);
        }*/


        $page->render();


    }

}