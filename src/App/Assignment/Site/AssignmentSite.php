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
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentSourceListBox;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentStatusListBox;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentCount;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentPaginationReader;
use Nemundo\Process\App\Survey\Content\Survey\SurveyContentType;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Site\ContentDeleteSite;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\User\Parameter\UserParameter;
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

        new AssignmentItemSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $dropdown = new ContentTypeDropdown($page);
        $dropdown->addContentType(new SurveyContentType());


        $parameter = new ContentTypeParameter();
        if ($parameter->exists()) {


            $parameter->addAllowedContentType(new SurveyContentType());

            $contentType = $parameter->getContentType();

            $form = $contentType->getForm($page);
            $form->redirectSite = AssignmentSite::$site;


        } else {


            $form = new SearchForm($page);

            $formRow = new BootstrapFormRow($form);

            $status = new AssignmentStatusListBox($formRow);
            $status->submitOnChange = true;
            $status->searchMode = true;

            $user = new UserListBox($formRow);
            $user->submitOnChange = true;
            $user->searchMode = true;


            $source = new AssignmentSourceListBox($formRow);
            $source->submitOnChange = true;
            $source->searchMode = true;

            // search form
            // source
            // user
            // status

            $assignmentReader = new AssignmentPaginationReader();
            $assignmentReader->model->loadGroup();
            $assignmentReader->model->loadSource();
            $assignmentReader->model->source->loadContentType();
            $assignmentReader->model->loadStatus();
            $assignmentReader->model->loadContent();
            $assignmentReader->model->content->loadUser();
            $assignmentReader->model->content->loadContentType();


            $filter = new Filter();

            $userParameter = new UserParameter();
            if ($userParameter->hasValue()) {

                $userFilter = new Filter();
                foreach ((new UserContentType($userParameter->getValue()))->getGroupIdList() as $groupId) {
                    $userFilter->orEqual($assignmentReader->model->groupId, $groupId);
                }
                $filter->andFilter($userFilter);

            }


            if ($status->hasValue()) {
                $filter->andEqual($assignmentReader->model->statusId, $status->getValue());
            }

            if ($source->hasValue()) {
                $filter->andEqual($assignmentReader->model->source->contentTypeId, $source->getValue());
            }


            $assignmentReader->filter = $filter;
            $assignmentReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


            $count = new AssignmentCount();
            $count->model->loadSource();
            $count->model->source->loadContentType();
            $count->filter = $filter;
            $assignmentCount = $count->getCount();

            $p = new Paragraph($page);
            $p->content = $assignmentCount . ' Assignments found';


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

                $row->addText($assignmentRow->source->contentType->contentType);
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

                if ($source->hasViewSite()) {
                    $row->addClickableSite($source->getViewSite());
                } else {

                    if ($source->hasView()) {

                        $site = clone(AssignmentItemSite::$site);
                        $site->addParameter(new ContentParameter($source->getContentId()));
                        $row->addClickableSite($site);

                    }


                }


            }

            $pagination = new BootstrapPagination($page);
            $pagination->paginationReader = $assignmentReader;


        }


        $page->render();

        // TODO: Implement loadContent() method.
    }

}