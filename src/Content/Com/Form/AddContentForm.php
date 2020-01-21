<?php


namespace Nemundo\Process\Content\Com\Form;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\TreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;


// Two Way possible
// AttachTo


class AddContentForm extends BootstrapForm  // AbstractContentForm
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var BootstrapListBox
     */
    private $content;

    public function getContent()
    {

        // search box

        $this->content= new BootstrapListBox($this);
        $this->content->label = 'Content';
        $this->content->validation=true;

        $contentReader=new ContentReader();
        $contentReader->addOrder($contentReader->model->subject);
        foreach ($contentReader->getData() as $contentRow) {
            $this->content->addItem($contentRow->id,$contentRow->subject);
        }


        return parent::getContent();
    }


    protected function onSubmit()
    {


        $writer = new TreeWriter();
        $writer->parentId = $this->content->getValue();  // $this->parentId;
        $writer->dataId = $this->contentType->getContentId();  // $this->contentId;
        $writer->write();

     /*   $builder=new TreeItem();
        $builder->parentId=$this->parentId;
        $builder->dataId=$this->content->getValue();
        $builder->saveTree();*/


    }

}