<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Content\Message\MessageAssignmentContentType;
use Nemundo\Process\App\Assignment\Install\AssignmentInstall;
use Nemundo\Process\App\Calendar\Data\CalendarCollection;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\News\Data\NewsCollection;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Plz\Content\PlzContentType;
use Nemundo\Process\App\Plz\Data\PlzCollection;
use Nemundo\Process\App\Survey\Content\Type\ErfassungContentType;
use Nemundo\Process\App\Survey\Content\Type\SurveyContentType;
use Nemundo\Process\App\Survey\Data\SurveyCollection;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Install\ContentTestInstall;
use Nemundo\Process\Content\Script\ContentUpdateScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Group\Install\GroupInstall;
use Nemundo\Process\Group\Setup\GroupSetup;
use Nemundo\Process\Group\Type\AbstractAppUserGroupType;
use Nemundo\Process\Group\Type\PublicGroupContentType;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Search\Install\SearchInstall;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Process\Template\Status\SubjectChange\SubjectChangeProcessStatus;
use Nemundo\Process\Workflow\Install\WorkflowInstall;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\User\Data\User\UserReader;

class ProcessTestInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentTestInstall())->install();


        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());
        $setup->addScript(new ContentUpdateScript());




    }

}