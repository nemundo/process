<?php


namespace Nemundo\Process\Template\Content\AddSource;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Reader\ContentTreeReader;
use Nemundo\Process\Template\Content\File\FileParentContainer;
use Nemundo\Process\Template\Site\SourceDeleteSite;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;


class AddSourceContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapListBox
     */
    private $source;

    public function getContent()
    {


        $table = new AdminTable($this);

        //$contentReader = new ContentTreeReader();
        //$contentReader->parentId=$this->parentId;

        $treeReader = new TreeReader();
        $treeReader->model->loadParent();
        $treeReader->model->parent->loadContentType();
        $treeReader->filter->andEqual($treeReader->model->childId, $this->parentId);
        $treeReader->addOrder($treeReader->model->parent->subject);
        foreach ($treeReader->getData() as $contentRow) {

            $row=new TableRow($table);
            $row->addText($contentRow->parent->subject);

            $site = clone(SourceDeleteSite::$site);
            $site->addParameter(new ContentParameter($contentRow->parentId));
            $site->addParameter(new ChildParameter($this->parentId));
            $row->addIconSite($site);

        }


/*
        foreach ($this->contentType->getParentContent() as $parentContentType) {

            $row=new TableRow($table);
            $row->addSite($parentContentType->getContentType()->getViewSite());

            $site = clone(SourceDeleteSite::$site);
            $site->addParameter(new ContentParameter($parentContentType->getc))

        }*/



        $this->source = new BootstrapListBox($this);
        $this->source->label='Quelle';
        $this->source->validation=true;

        $treeReader = new ContentReader();
        /*$treeReader->filter->orEqual($treeReader->model->contentTypeId,(new ProzesssteuerungProjektContentType())->typeId);
        $treeReader->filter->orEqual($treeReader->model->contentTypeId,(new AufgabeProcess())->typeId);
        $treeReader->filter->orEqual($treeReader->model->contentTypeId,(new EcrProcess())->typeId);*/

        $treeReader->addOrder($treeReader->model->subject);
        foreach ($treeReader->getData() as $contentRow) {
            $this->source->addItem($contentRow->id, $contentRow->subject);
        }

        return parent::getContent();

    }



    protected function onSubmit()
    {

        $type=new AddSourceContentType();
        $type->parentId=$this->parentId;
        $type->sourceId=$this->source->getValue();
        $type->saveType();

        // TODO: Implement onSubmit() method.
    }


}