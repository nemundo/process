<?php


namespace Nemundo\Process\App\Document\Com;


use Nemundo\Package\Bootstrap\Tabs\BootstrapTabs;
use Nemundo\Package\Bootstrap\Tabs\BootstrapTabsDropdown;
use Nemundo\Package\Bootstrap\Tabs\BootstrapTabsItem;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeReader;
use Nemundo\Process\App\Document\Site\DocumentNewSite;
use Nemundo\Process\App\Document\Site\DocumentSite;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;

class DocumentTabs extends BootstrapTabs
{

    public function getContent()
    {

        $item = new BootstrapTabsItem($this);
        $item->site = DocumentSite::$site;
        $item->active = true;

        $dropdown = new BootstrapTabsDropdown($this);
        $dropdown->dropdownLabel = 'New';

        $reader = new DocumentTypeReader();
        $reader->model->loadContentType();
        $reader->addOrder($reader->model->contentType->contentType);
        foreach ($reader->getData() as $documentTypeRow) {

            $site = clone(DocumentNewSite::$site);
            $site->title = $documentTypeRow->contentType->contentType;
            $site->addParameter(new ContentTypeParameter($documentTypeRow->contentTypeId));
            $dropdown->addSite($site);

        }

        return parent::getContent();

    }

}