<?php


namespace Nemundo\Process\App\Assignment\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentSourceListBox;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentStatusListBox;
use Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndexPaginationReader;
use Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndexReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class AssignmentIndexSite extends AbstractSite
{

    /**
     * @var AssignmentIndexSite
     */
    public static $site;

    protected function loadSite()
    {
        // Assignment Task
        $this->title = 'Assignment Index';
        $this->url = 'assignment-index';  // 'group-assignment';
        AssignmentIndexSite::$site = $this;


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


        $content = new AssignmentSourceListBox($formRow);
        $content->submitOnChange = true;
        $content->searchMode = true;

        // search form
        // source
        // user
        // status

        $indexReader = new AssignmentIndexPaginationReader();
        $indexReader->model->loadAssignment();
        $indexReader->model->loadSource();
        $indexReader->model->source->loadContentType();
        //$assignmentReader->model->loadStatus();
        $indexReader->model->loadContent();
        $indexReader->model->content->loadUser();
        $indexReader->model->content->loadContentType();


        $indexReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        $indexReader->addOrder($indexReader->model->id, SortOrder::DESCENDING);


        $count = new CountField($indexReader);

        $indexReader->addGroup($indexReader->model->contentId);



        /*
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
            $assignmentReader->addOrder($assignmentReader->model->id, SortOrder::DESCENDING);


            $count = new AssignmentCount();
            $count->model->loadSource();
            $count->model->source->loadContentType();
            $count->filter = $filter;
            $assignmentCount = $count->getCount();

            $p = new Paragraph($page);
            $p->content = $assignmentCount . ' Assignments found';*/


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        //$header->addText('Status');
        $header->addEmpty();

        $header->addText($indexReader->model->content->label);


        $header->addText($indexReader->model->assignment->label);
        $header->addText($indexReader->model->deadline->label);
        $header->addText($indexReader->model->source->label);
        $header->addText('Anzahl Quellen');

        $header->addText($indexReader->model->closed->label);

        foreach ($indexReader->getData() as $assignmentRow) {


            $content = $assignmentRow->content->getContentType();

            $row = new BootstrapClickableTableRow($table);

            //$row->addText($assignmentRow->status->status);

            $trafficLight = new DateTrafficLight($row);
            $trafficLight->date = $assignmentRow->deadline;

            //$row->addText($assignmentRow->content->contentType->contentType);
            $row->addText($assignmentRow->content->subject);


            $row->addText($assignmentRow->assignment->group);

            if ($assignmentRow->deadline !== null) {
                $row->addText($assignmentRow->deadline->getShortDateLeadingZeroFormat());
            } else {
                $row->addEmpty();
            }

            //$row->addText($assignmentRow->source->contentType->contentType);
            $row->addText($assignmentRow->source->subject);

            $sourceCount = $assignmentRow->getModelValue($count);

            $ul=new UnorderedList($row);
            if ($sourceCount>1) {
                $sourceReader = new AssignmentIndexReader();
                $sourceReader->model->loadSource();
                $sourceReader->filter->andEqual($sourceReader->model->contentId, $assignmentRow->contentId);
                foreach ($sourceReader->getData() as $sourceRow) {
                    $ul->addText($sourceRow->source->subject);

                }
            }


            $row->addText($sourceCount);


            $row->addYesNo($assignmentRow->closed);


            //$row->addText($assignmentRow->getModelValue($contentModel->dateTime));
            //$row->addText($assignmentRow->getModelValue($contentModel->user->displayName));


            //$row->addText($assignmentRow->getModelValue($contentModel->contentType->contentType));


            // $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());


            /*
            $row->addText($assignmentRow->content->contentType->phpClass);

            $row->addText($assignmentRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($assignmentRow->content->user->displayName);


            //$row->addText($assignmentRow->message);

            /*
            $contentType =$contentRow->getContentType()->getParentContentType();

            $row->addText($contentType->getSubject());
            $row->addText($contentType->typeLabel);*/

            /*$site = clone(ContentDeleteSite::$site);
            $site->addParameter(new ContentParameter($assignmentRow->contentId));
            $row->addIconSite($site);*/

            if ($content->hasViewSite()) {
                $row->addClickableSite($content->getViewSite());
            } else {

                if ($content->hasView()) {

                    $site = clone(AssignmentItemSite::$site);
                    $site->addParameter(new ContentParameter($content->getContentId()));
                    $row->addClickableSite($site);

                }


            }


        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $indexReader;


        //}


        $page->render();

        // TODO: Implement loadContent() method.
    }

}