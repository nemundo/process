<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowCount;
use Nemundo\Web\Site\AbstractSite;

class ContentLogSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Content Log';
        $this->url = 'content-log';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $table = new AdminLabelValueTable($page);
        $table->addLabelValue('Content Item', (new ContentCount())->getCount());
        $table->addLabelValue('Tree Item', (new TreeCount())->getCount());
        $table->addLabelValue('Workflow Item', (new WorkflowCount())->getCount());


        $page->render();


    }


}