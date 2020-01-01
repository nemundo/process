<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Site\AbstractSite;

class AssignmentSite extends AbstractSite
{
    protected function loadSite()
    {
     $this->title='Assignment';
     $this->url='assignment';
        // TODO: Implement loadSite() method.
    }

    public function loadContent()
    {
     $page=(new DefaultTemplateFactory())->getDefaultTemplate();

     $layout=new BootstrapTwoColumnLayout($page);



     // assignment get parent (multi möglich)

    // source id







     $table= new AdminTable($layout->col2);
     $reader=new GroupUserReader();
     $reader->model->loadGroup();
     $reader->model->group->loadGroupType();
     $reader->filter->andEqual($reader->model->userId, (new UserSessionType())->userId);
     foreach ($reader->getData() as $groupUserRow) {
         $row=new TableRow($table);
         $row->addText($groupUserRow->group->group);
         $row->addText($groupUserRow->group->groupType->groupType);
     }



     $page->render();
        // TODO: Implement loadContent() method.
    }

}