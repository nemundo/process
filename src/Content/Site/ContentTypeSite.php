<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Type\Number\Number;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
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


        $table = new AdminTable($page);

        $header = new TableHeader($table);
        $header->addText('Type');
        $header->addText('Type Id');
        $header->addText('Class');
        $header->addText('Item Count');


        $reader = new ContentTypeReader();
        $reader->addOrder($reader->model->contentType);
        foreach ($reader->getData() as $contentTypeRow) {

            $row = new TableRow($table);

            $row->addText($contentTypeRow->contentType);
            $row->addText($contentTypeRow->id);
            $row->addText($contentTypeRow->phpClass);

            $count = new ContentCount();
            $count->filter->andEqual($count->model->contentTypeId,$contentTypeRow->id);
            $row->addText((new Number( $count->getCount()))->formatNumber());


        }


        /*
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


        }*/

        $page->render();


    }


}