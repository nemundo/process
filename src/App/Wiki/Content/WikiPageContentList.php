<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\View\AbstractContentList;

class WikiPageContentList extends AbstractContentList
{

    public function getContent()
    {

        $this->redirectSite = WikiSite::$site;
        $this->redirectParameter =new WikiParameter();

        $list = new BootstrapHyperlinkList($this);

        $reader = new WikiReader();
        $reader->addOrder($reader->model->title);
        foreach ($reader->getData() as $wikiRow) {



            /*$site = clone(WikiSite::$site);
            $site->title = $wikiRow->title;
            $site->addParameter(new WikiParameter($wikiRow->id));

            $list->addSite($site);*/

            $site = $this->getRedirectSite($wikiRow->id);
            $site->title=$wikiRow->title;
            $list->addSite($site);

        }

        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}