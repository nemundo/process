<?php


namespace Nemundo\Process\App\Document\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeReader;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class DocumentSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Document';
        $this->url = 'document';
        // TODO: Implement loadSite() method.
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $dropdown = new ContentTypeDropdown($page);

        $reader = new DocumentTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $documentTypeRow) {
            $dropdown->addContentType($documentTypeRow->contentType->getContentType());
        }

        //foreach ()

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {


            $layout = new BootstrapThreeColumnLayout($page);


            $contentType = $contentTypeParameter->getContentType();

            $form = $contentType->getForm($layout->col1);
            $form->redirectSite = new Site();

            $contentType->getList($layout->col2);


            $dataParameter=new DataParameter();
            if ($dataParameter->exists()) {

                $contentType = $contentTypeParameter->getContentType($dataParameter->getValue());

                $contentType->getView($layout->col3);

            }



        }








        $page->render();

        // TODO: Implement loadContent() method.
    }

}