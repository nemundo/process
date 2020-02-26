<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Com\FormBuilder\SearchForm;

use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Http\Request\Get\GetRequestReader;
use Nemundo\Core\Http\Request\Post\PostRequest;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;
use Nemundo\Process\Content\Form\AbstractContentContainer;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\Source\Collection\SourceContentTypeCollection;
use Nemundo\Web\Parameter\UrlParameter;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;


class SourceAddContentContainer extends AbstractContentContainer
{

    /**
     * @var BootstrapListBox
     */
    private $source;

    public function getContent()
    {

        //$p=new Paragraph($this);
        //$p->content= $this->contentType->getClassName();


        /*
        $p = new Paragraph($this);
        $p->content = $this->redirectSite->getUrl();


        $p = new Paragraph($this);
        $p->content =  (new PostRequest((new SourceParameter())->getParameterName()))->getValue();*/

        $sourceParameter=new SourceParameter();

//        $form = new BootstrapForm($this);  // new SearchForm($this);

        $form =  new SearchForm($this);
        $form->addUrlAsHiddenInput=true;
        $form->addInputName((new SourceParameter())->getParameterName());


        $listbox = new BootstrapListBox($form);
        $listbox->label = 'Quelle';
        $listbox->submitOnChange=true;
        $listbox->searchMode=true;
        $listbox->name=(new SourceParameter())->getParameterName();
        $listbox->value=  (new PostRequest((new SourceParameter())->getParameterName()))->getValue();  // $sourceParameter->getValue();

        /*$collection = new \Nemundo\Process\Content\Collection\ContentTypeCollection();
        $collection->addContentType(new VerbesserungProcess());
        $collection->addContentType(new AufgabeProcess());*/

        $collection=new SourceContentTypeCollection();

        foreach ($collection->getContentTypeList() as $contentType) {
            $listbox->addItem($contentType->typeId, $contentType->typeLabel);
        }


        if ($sourceParameter->hasValue()) {

        $form=new SourceAddContentForm($this);
        $form->contentType=$this->contentType;
        $form->parentId=$this->parentId;
        $form->redirectSite=$this->redirectSite;

        }

        return parent::getContent();

    }




}