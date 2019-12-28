<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Template\Content\Event\EventContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;

class WikiPageContentType extends AbstractContentType
{

    use MenuTrait;

    protected function loadContentType()
    {

        $this->id ='b94ec710-d1bd-4430-8866-4a7f9a493c52';
        $this->type='Wiki Page';
        $this->formClass=WikiPageContentForm::class;
        $this->listClass=WikiPageContentList::class;
        $this->itemClass=WikiPageContentItem::class;

        $this->viewSite= WikiSite::$site;
        $this->parameterClass=WikiParameter::class;


        $this->addMenuClass(LargeTextContentType::class);
        $this->addMenuClass(EventContentType::class);


    }


    /*
    public function getSubject($dataId)
    {

        $wikiRow = (new WikiReader())->getRowById($dataId);
        $subject = 'Wiki: '. $wikiRow->title;

        return $subject;

    }*/

}