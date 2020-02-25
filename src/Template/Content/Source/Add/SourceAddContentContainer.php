<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Com\FormBuilder\SearchForm;

use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Http\Request\Get\GetRequestReader;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;
use Nemundo\Process\Content\Form\AbstractContentContainer;
use Nemundo\Process\Content\Form\AbstractContentForm;
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


        $sourceParameter=new SourceParameter();

        $form = new SearchForm($this);


        $listbox = new BootstrapListBox($form);
        $listbox->label = 'Quelle';
        $listbox->submitOnChange=true;
        $listbox->searchMode=true;
        $listbox->name=(new SourceParameter())->getParameterName();

        $collection = new \Nemundo\Process\Content\Collection\ContentTypeCollection();
        $collection->addContentType(new VerbesserungProcess());
        $collection->addContentType(new AufgabeProcess());

        foreach ($collection->getContentTypeList() as $contentType) {
            $listbox->addItem($contentType->typeId, $contentType->typeLabel);
        }


        if ($sourceParameter->hasValue()) {

        $form=new SourceAddContentForm($this);
        $form->parentId=$this->parentId;
        $form->redirectSite=$this->redirectSite;

        }

        return parent::getContent();

    }




}