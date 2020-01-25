<?php


namespace Nemundo\Process\App\Assignment\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Filter\Filter;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentStatusListBox;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentCount;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentPaginationReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Site\ContentDeleteSite;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\User\Session\UserSession;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class AssignmentSite extends AbstractSite
{

    /**
     * @var AssignmentSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Assignment';
        $this->url = 'group-assignment';
        AssignmentSite::$site = $this;
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $status = new AssignmentStatusListBox($formRow);
        $status->submitOnChange = true;
        $status->searchMode = true;

        $user = new UserListBox($formRow);
        $user->submitOnChange = true;
        $user->searchMode = true;


        // search form
        // source
        // user
        // status

        $assignmentReader = new AssignmentPaginationReader();
        $assignmentReader->model->loadGroup();
        $assignmentReader->model->loadSource();
        $assignmentReader->model->loadStatus();
        $assignmentReader->model->loadContent();
        $assignmentReader->model->content->loadUser();
        $assignmentReader->model->content->loadContentType();
        $assignmentReader->model->source->loadContentType();


        $filter = new Filter();

        $userParameter = new UserParameter();
        if ($userParameter->hasValue()) {

            $userFilter = new Filter();
            foreach ((new UserContentType((new UserSession())->userId))->getGroupIdList() as $groupId) {
                $userFilter->orEqual($assignmentReader->model->groupId, $groupId);
            }
            $filter->andFilter($filter);

        }


        if ($status->hasValue()) {
            $filter->andEqual($assignmentReader->model->statusId, $status->getValue());
        }

        $assignmentReader->filter = $filter;
        $assignmentReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


        $count = new AssignmentCount();
        $count->filter = $filter;
        $assignmentCount=$count->getCount();

        $p=new Paragraph($page);
        $p->content=$assignmentCount.' Assignments found';



        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Status');
        $header->addEmpty();
        $header->addText('Source');
        $header->addText('Assignment');
        $header->addText('Deadline');
        $header->addText('Message');


        foreach ($assignmentReader->getData() as $assignmentRow) {


            $source = $assignmentRow->source->getContentType();

            $row = new BootstrapClickableTableRow($table);

            $row->addText($assignmentRow->status->status);

            $trafficLight = new DateTrafficLight($row);
            $trafficLight->date = $assignmentRow->deadline;

            $row->addText($assignmentRow->source->subject);
            $row->addText($assignmentRow->group->group);

            if ($assignmentRow->deadline !== null) {
                $row->addText($assignmentRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }


            //$row->addText($assignmentRow->getModelValue($contentModel->dateTime));
            //$row->addText($assignmentRow->getModelValue($contentModel->user->displayName));


            //$row->addText($assignmentRow->getModelValue($contentModel->contentType->contentType));


            // $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());


            $row->addText($assignmentRow->content->contentType->phpClass);

            $row->addText($assignmentRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($assignmentRow->content->user->displayName);


            $row->addText($assignmentRow->message);

            /*
            $contentType =$contentRow->getContentType()->getParentContentType();

            $row->addText($contentType->getSubject());
            $row->addText($contentType->typeLabel);*/

            $site = clone(ContentDeleteSite::$site);
            $site->addParameter(new ContentParameter($assignmentRow->contentId));
            $row->addIconSite($site);


            $row->addClickableSite($source->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $assignmentReader;


        $page->render();

        // TODO: Implement loadContent() method.
    }

}