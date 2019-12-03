<?php


namespace Nemundo\Process\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Web\Site\AbstractSite;

class ProcessSite extends AbstractSite
{

    protected function loadSite()
    {
        // TODO: Implement loadSite() method.
        $this->title = 'Process';
        $this->url = 'process';
    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $table = new AdminTable($page);


        $reader = new WorkflowReader();
        foreach ($reader->getData() as $workflowRow) {




        }


        $page->render();


    }

}