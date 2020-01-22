<?php

namespace Nemundo\Process\App\Assignment\Widget;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Db\Filter\Filter;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentPaginationReader;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Session\UserSession;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;
use Schleuniger\App\Aufgabe\Site\AufgabeSite;
use Schleuniger\Config\SchleunigerConfig;

class AssignmentWidget extends AdminWidget
{


    protected function loadWidget()
    {

        $this->widgetTitle[LanguageCode::EN] = 'Assignment';
        $this->widgetTitle[LanguageCode::DE] = 'Aufgaben';
        //$this->widgetId = '4157c73c-d498-42cb-865c-ff696e4005de';

        //$this->widgetSite = AufgabenSit AssignmentSite:: NotificationSite::$site;

        $this->widgetSite = AufgabeSite::$site;

    }

    public function getContent()
    {


        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addEmpty();

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Source';
        $th->content[LanguageCode::DE] = 'Quelle';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Subject';
        $th->content[LanguageCode::DE] = 'Betreff';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Message';
        $th->content[LanguageCode::DE] = 'Nachricht';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Assignment';
        $th->content[LanguageCode::DE] = 'Verantwortlicher';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Deadline';
        $th->content[LanguageCode::DE] = 'Erledigen bis';




        $assignmentReader = new AssignmentPaginationReader();
        $assignmentReader->model->loadSource();
        $assignmentReader->model->source->loadContentType();
        $assignmentReader->model->loadStatus();
        $assignmentReader->model->loadContent();
        $assignmentReader->model->loadGroup();
        $assignmentReader->model->content->loadUser();
        $assignmentReader->model->content->loadContentType();


        $filter = new Filter();
        $userType = new UserContentType((new UserSession())->userId);
        foreach ($userType->getGroupIdList() as $groupId) {
            $filter->orEqual($assignmentReader->model->groupId, $groupId);
        }
        $assignmentReader->filter->andFilter($filter);

        $assignmentReader->filter->andEqual($assignmentReader->model->statusId, (new OpenAssignmentStatus())->id);

        //$assignmentReader->addOrder($assignmentReader->model->sourceId, SortOrder::DESCENDING);


        $assignmentReader->paginationLimit = SchleunigerConfig::PAGINATION_LIMIT;


        foreach ($assignmentReader->getData() as $assignmentRow) {

            $contentType = $assignmentRow->source->getContentType();

            $row = new BootstrapClickableTableRow($table);

            $trafficLight = new DateTrafficLight($row);
            $trafficLight->date = $assignmentRow->deadline;

            $row->addText($assignmentRow->source->contentType->contentType);

            $row->addText($assignmentRow->source->subject);
            $row->addText($assignmentRow->message);

            $row->addText($assignmentRow->group->group);


            if ($assignmentRow->deadline !== null) {
                $row->addText($assignmentRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            //$row->addText($assignmentRow->content->user->displayName . ' ' . $assignmentRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());


            $row->addClickableSite($contentType->getViewSite());

        }


        return parent::getContent();

    }

}