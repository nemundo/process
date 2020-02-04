<?php


namespace Nemundo\Process\App\Document\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Text\TextBold;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Document\Data\Document\DocumentModel;
use Nemundo\Process\App\Document\Data\Document\DocumentRow;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\Web\Site\AbstractSite;

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


        $form = new ContentSearchForm($page);


        $bold = new TextBold();
        $bold->addSearchQuery($form->getSearchQuery());

        // search
        // filter

        //(new Debug())->write($form->getWordId());

        // $searchIndexReader = new SearchIndexReader();  // new SearchIndexPaginationReader();
        $searchIndexReader = new SearchIndexPaginationReader();

        //$reader2= new SearchIndexPaginationReader();

        $searchIndexReader->model->loadContent();
        $searchIndexReader->model->content->loadContentType();
        $searchIndexReader->filter->andEqual($searchIndexReader->model->wordId, $form->getWordId());


        $externalModel = new DocumentModel();
        $externalModel->loadSource();
        $externalModel->loadContent();
        $externalModel->content->loadContentType();

        $join = new ModelJoin($searchIndexReader);
        $join->type = $searchIndexReader->model->contentId;
        $join->externalModel = $externalModel;
        $join->externalType = $externalModel->contentId;

        //$searchIndexReader->addJoinExternal2($externalModel);
        //$searchIndexReader->addFieldByModel($externalModel);
        //$searchIndexReader->checkExternal($externalModel);
        //$searchIndexReader->checkExternal($externalModel->source);

        $table = new AdminClickableTable($page);

        /*  $documentReader = new DocumentReader();
          $documentReader->model->loadContent();
          $documentReader->model->content->loadContentType();
          $documentReader->model->loadSource();

          $table = new AdminClickableTable($page);*/


        $header = new TableHeader($table);
        $header->addText($externalModel->source->label);
        $header->addText($externalModel->title->label);
        $header->addText($externalModel->text->label);
        $header->addText($searchIndexReader->model->content->dateTime->label);

        //DbConfig::$sqlDebug = true;

        foreach ($searchIndexReader->getData() as $indexRow) {

            $row = new BootstrapClickableTableRow($table);
            //$row->addText($indexRow->contentId);

            //$row->addText($indexRow->content->subject);

            //$row->addText($indexRow->getModelValue($externalModel->source->subject));
            //$row->addText($indexRow->getModelValue($externalModel->title));
            //$row->addText($indexRow->getModelValue($externalModel->text));


            $documentRow = new DocumentRow($indexRow, $externalModel);

            $row->addText($bold->getBoldText($documentRow->source->subject));
            $row->addText($bold->getBoldText($documentRow->title));
            $row->addText($bold->getBoldText($documentRow->text));

            $row->addText($documentRow->content->dateTime->getShortDateTimeLeadingZeroFormat());
            $row->addText($documentRow->content->contentType->contentType);


            //$row->addText($documentRow->source->subject);

            //$row->addText($documentRow->title);

            /*
            $row->addText($documentRow->source->subject);
            $row->addText($documentRow->title);
            $row->addText($documentRow->text);
            $row->addText($documentRow->content->contentType->contentType);
            $row->addText($documentRow->content->dateTime->getShortDateTimeLeadingZeroFormat());*/


            /*
            $ul = new UnorderedList($row);

            $indexReader = new SearchIndexReader();
            $indexReader->model->loadWord();
            $indexReader->filter->andEqual($indexReader->model->contentId, $documentRow->contentId);
            foreach ($indexReader->getData() as $indexRow) {
                $ul->addText($indexRow->word->word);
            }*/


            $contentType = $indexRow->content->getContentType();
            $row->addClickableSite($contentType->getViewSite());

        }


        //DbConfig::$sqlDebug = false;


        /*

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


            /*
            $dataParameter=new DataParameter();
            if ($dataParameter->exists()) {

                $contentType = $contentTypeParameter->getContentType($dataParameter->getValue());

                $contentType->getView($layout->col3);

            }*/


        //}


        $page->render();

        // TODO: Implement loadContent() method.
    }

}