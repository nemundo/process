<?php


namespace Nemundo\Process\App\Assignment\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentPaginationReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Site\ContentDeleteSite;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class AssignmentSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Assignment';
        $this->url = 'group-assignment';

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        // search form
        // source
        // user

        $assignmentReader = new AssignmentPaginationReader();
        $assignmentReader->model->loadGroup();
        $assignmentReader->model->loadSource();
        $assignmentReader->model->loadStatus();
        $assignmentReader->model->loadContent();
        $assignmentReader->model->content->loadUser();
        $assignmentReader->model->content->loadContentType();


        $assignmentReader->model->source->loadContentType();



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