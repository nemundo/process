<?php


namespace Nemundo\Process\Template\Content\Source\Remove;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Hyperlink\SiteHyperlink;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\FontAwesome\Icon\PlusIcon;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Form\AbstractContentActionPanel;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Template\Content\Source\Add\SourceAddContentType;
use Nemundo\Process\Workflow\Parameter\StatusParameter;
use Nemundo\Web\Action\ActionSite;
use Nemundo\Web\Action\Site\DeleteActionSite;
use Nemundo\Web\Site\Site;

class SourceRemoveContentPanel extends AbstractContentActionPanel
{

    /**
     * @var SourceRemoveContentType
     */
    public $contentType;

    /**
     * @var ActionSite
     */
    private $index;

    /**
     * @var ActionSite
     */
    private $delete;

    protected function loadActionSite()
    {

        $this->index = new ActionSite($this);
        $this->index->onAction = function () {


            $table = new AdminTable($this);

            //$contentReader = new ContentTreeReader();
            //$contentReader->parentId=$this->parentId;*/


            $header = new TableHeader($table);
            $header->addText('Quelle');
            if ($this->contentType->editable) {
                $header->addEmpty();
            }


            $treeReader = new TreeReader();
            $treeReader->model->loadParent();
            $treeReader->model->parent->loadContentType();
//            $treeReader->filter->andEqual($treeReader->model->childId, $this->parentId);
            $treeReader->filter->andEqual($treeReader->model->childId, $this->contentType->getParentId());

            $treeReader->addOrder($treeReader->model->parent->subject);
            foreach ($treeReader->getData() as $contentRow) {


                $row = new TableRow($table);
                $row->addSite($contentRow->parent->getContentType()->getSubjectViewSite());

                //$row->addText($contentRow->parent->subject);

                if ($this->contentType->editable) {
                    $site = clone($this->delete);
                    $site->addParameter(new ContentParameter($contentRow->parentId));  // parentId));
                    //$site->addParameter(new ChildParameter($this->parentId));
                    $row->addIconSite($site);
                }


            }


            if ($this->contentType->editable) {
                $add = new SiteHyperlink($this);
                $add->showSiteTitle = false;
                $add->site = new Site();
                $add->site->addParameter(new StatusParameter((new SourceAddContentType())->typeId));
                new PlusIcon($add);
            }

            /*
                    foreach ($this->contentType->getParentContent() as $parentContentType) {

                        $row=new TableRow($table);
                        $row->addSite($parentContentType->getContentType()->getViewSite());

                        $site = clone(SourceDeleteSite::$site);
                        $site->addParameter(new ContentParameter($parentContentType->getc))

                    }*/


        };


        $this->delete = new DeleteActionSite($this);
        $this->delete->title = 'Quelle entfernen';
        $this->delete->onAction = function () {

            //(new Debug())->write($this->parentId);
            //(new Debug())->write('delete');

            $type = new SourceRemoveContentType();
            //$type->parentId = $this->parentId;
            $type->parentId = $this->contentType->getParentId();
            $type->removeId = (new ContentParameter())->getValue();
            $type->saveType();

            $this->redirectSite->redirect();

            //exit;

        };

    }


}