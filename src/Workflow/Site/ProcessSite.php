<?php


namespace Nemundo\Process\Workflow\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Web\Site\AbstractSite;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;

class ProcessSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title='Process';
        $this->url='process-overview';
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $process = new VerbesserungProcess();


        $table = new AdminTable($page);


        foreach ($process->getProcessStatusList() as $status) {


            $row=new TableRow($table);
            $row->addText($status->typeLabel);


            //$this->addContentType($status);

            $ul = new UnorderedList($row);
            foreach ($status->getMenuList() as $menuStatus) {
                $ul->addText($menuStatus->typeLabel);
            }

        }




        $page->render();


    }







}