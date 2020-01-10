<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Core\Debug\Debug;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\AbstractSite;

class ContentTypeSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Content Type';
        $this->url = 'content-type';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new ContentTypeListBox($formRow);
        //$listbox->name = (new ContentTypeParameter())->parameterName;
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            //    $contentReader->filter->andEqual($contentReader->model->contentTypeId, $contentTypeParameter->getValue());

            $contentType = $contentTypeParameter->getContentType();

           // (new Debug())->write($contentType);


            if ($contentType->hasList()) {
                $contentType->getList($page);
            }


            if ($contentType->hasAdmin()) {
                $contentType->getAdmin($page);
            }


        }

        $page->render();


    }


}