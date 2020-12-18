<?php


namespace Nemundo\Process\App\Notification\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Core\Language\Translation;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Dashboard\Setup\DashboardSetup;
use Nemundo\Process\App\Notification\Category\AbstractCategory;
use Nemundo\Process\App\Notification\Category\InformationCategory;
use Nemundo\Process\App\Notification\Category\TaskCategory;
use Nemundo\Process\App\Notification\Content\Widget\NotificationWidgetContentType;
use Nemundo\Process\App\Notification\Data\Category\Category;
use Nemundo\Process\App\Notification\Data\NotificationCollection;
use Nemundo\Process\App\Notification\Script\NotificationIndexScript;
use Nemundo\Process\App\Notification\Script\NotificationUpdateScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class NotificationInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new NotificationCollection());

        $this->addCategory(new InformationCategory());
        $this->addCategory(new TaskCategory());


        $setup = new ScriptSetup();
        $setup->addScript(new NotificationUpdateScript());

        (new ScriptSetup())
            ->addScript(new NotificationIndexScript());

        /*(new DashboardSetup())
            ->addDashboard(new NotificationWidgetContentType());*/

        (new NotificationTestInstall())->install();


    }


    private function addCategory(AbstractCategory $category)
    {

        $data = new Category();
        $data->updateOnDuplicate = true;
        $data->id = $category->id;
        $data->category = (new Translation())->getText($category->category);
        $data->save();


    }


}