<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\Number\Number;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\AbstractSite;

class ContentCheckSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Content Check';
        $this->url = 'content-check';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site=ContentSite::$site;


        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Data Id is Null';

        $table = new AdminTable($page);

        $header=new TableHeader($table);
        $header->addText('Content Id');

        $reader = new ContentReader();
        $reader->filter->andIsNull($reader->model->dataId);
        foreach ($reader->getData() as $contentRow) {
        //    (new Debug())->write('Data Id is Null. Content Id ' . $contentRow->id);
        $row= new TableRow($table);
        $row->addText($contentRow->id);
        }



        $subtitle = new AdminSubtitle($page);
        $subtitle->content = 'Tree Parent/Child missing';

        $table = new AdminTable($page);

        $header=new TableHeader($table);

        $header->addText('Tree Id');
        $header->addText('Child Id');
        $header->addText('Parent Id');


        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->loadParent();
        foreach ($reader->getData() as $treeRow) {


            if (!$this->checkContent($treeRow->parentId)) {
                //(new Debug())->write('Parent is missing. Tree Id: ' . $treeRow->id);

                $row = new TableRow($table);
                $row->addText($treeRow->id);
                $row->addText($treeRow->childId);
                $row->addText($treeRow->child->subject);
                $row->addText($treeRow->parentId);
                $row->addText($treeRow->parent->subject);
                $row->addText('Parent is missing');

            }

            if (!$this->checkContent($treeRow->childId)) {
                //(new Debug())->write('Child is missing. Tree Id: ' . $treeRow->id);
                $row = new TableRow($table);
                $row->addText($treeRow->id);
                $row->addText($treeRow->childId);
                $row->addText($treeRow->parentId);
                $row->addText('Child is missing');

            }


        }




        $page->render();


    }


    private function checkContent($contentId)
    {

        $found = false;
        $count = new ContentCount();
        $count->filter->andEqual($count->model->id, $contentId);
        if ($count->getCount() > 0) {
            $found = true;
        }

        return $found;


    }

}