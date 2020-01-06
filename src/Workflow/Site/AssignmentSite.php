<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogPaginationReader;
use Nemundo\Web\Site\AbstractSite;

class AssignmentSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Assignment';
        $this->url = 'assignment';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);


        // assignment get parent (multi möglich)

        // source id


        $table =new AdminClickableTable($layout->col2);


        $reader = new UserAssignmentLogPaginationReader();
        $reader->model->loadUser();
        foreach ($reader->getData() as $assignmentLogRow) {

            $row=new BootstrapClickableTableRow($table);
            $row->addText($assignmentLogRow->user->displayName);

            //$row->addText($assignmentLogRow-> >user->displayName);



        }



        /*     $reader=new GroupUserReader();
             $reader->model->loadGroup();
             $reader->model->group->loadGroupType();
             $reader->filter->andEqual($reader->model->userId, (new UserSessionType())->userId);
             foreach ($reader->getData() as $groupUserRow) {
                 $row=new TableRow($table);
                 $row->addText($groupUserRow->group->group);
                 $row->addText($groupUserRow->group->groupType->groupType);
             }*/


        $page->render();
        // TODO: Implement loadContent() method.
    }

}