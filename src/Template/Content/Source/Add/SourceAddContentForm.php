<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;


class SourceAddContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapListBox
     */
    private $content;

    public function getContent()
    {


        //$p=new Paragraph($this);
        //$p->content= $this->contentType->getClassName();


       /* $listbox = new BootstrapListBox($this);
        //$listbox->submitOnChange=true;

        $collection = new \Nemundo\Process\Content\Collection\ContentTypeCollection();
        $collection->addContentType(new VerbesserungProcess());
        $collection->addContentType(new AufgabeProcess());

        foreach ($collection->getContentTypeList() as $contentType) {
            $listbox->addItem($contentType->typeId, $contentType->typeLabel);
        }*/


        /*$table = new AdminTable($this);

        //$contentReader = new ContentTreeReader();
        //$contentReader->parentId=$this->parentId;*/

        /*
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

        }*/


        /*
                foreach ($this->contentType->getParentContent() as $parentContentType) {

                    $row=new TableRow($table);
                    $row->addSite($parentContentType->getContentType()->getViewSite());

                    $site = clone(SourceDeleteSite::$site);
                    $site->addParameter(new ContentParameter($parentContentType->getc))

                }*/


        $sourceId = (new SourceParameter())->getValue();

        $this->content = new BootstrapListBox($this);
        $this->content->label= 'Content';  // 'Quelle';
        $this->content->validation=true;

        $treeReader = new ContentReader();
        $treeReader->filter->orEqual($treeReader->model->contentTypeId,$sourceId);
        //$treeReader->filter->orEqual($treeReader->model->contentTypeId,(new AufgabeProcess())->typeId);
        //$treeReader->filter->orEqual($treeReader->model->contentTypeId,(new EcrProcess())->typeId);*/

         $treeReader->addOrder($treeReader->model->subject);
         foreach ($treeReader->getData() as $contentRow) {
             $this->content->addItem($contentRow->id, $contentRow->subject);
         }

        return parent::getContent();

    }


    protected function onSubmit()
    {

        //$type = new SourceAddContentType();
        //$type->parentId = $this->parentId;
        $this->contentType->sourceId = $this->content->getValue();
        $this->contentType->saveType();

        // TODO: Implement onSubmit() method.
    }


}