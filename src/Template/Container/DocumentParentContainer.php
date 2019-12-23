<?php


namespace Nemundo\Process\Template\Container;


use Nemundo\Admin\Com\Table\AdminTable;

use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Parameter\DocumentParameter;
use Nemundo\Process\Template\Site\DocumentDeleteSite;
use Nemundo\Process\Template\Status\DocumentProcessStatus;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Workflow\App\WorkflowTemplate\Com\WorkflowFancyboxHyperlink;


class DocumentParentContainer extends AbstractParentContainer
{



    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Dokument');
        $header->addText('Ersteller');
        $header->addEmpty();

        $documentReader = new DocumentReader();

        $externalModel = new TreeModel();  // new ContentModel();
        $externalModel->loadUser();

        $join = new ModelJoin($documentReader);
        $join->type = $documentReader->model->id;
        $join->externalModel = $externalModel;
        $join->externalType = $externalModel->dataId;

        $documentReader->filter->andEqual($externalModel->parentId, $this->parentId);
        $documentReader->filter->andEqual($externalModel->contentTypeId, (new DocumentProcessStatus())->id);

        $documentReader->checkExternal($externalModel);
        $documentReader->addFieldByModel($externalModel);

        $documentReader->addOrder($documentReader->model->document->fileName);
        foreach ($documentReader->getData() as $documentRow) {

            $row = new TableRow($table);

            if ($documentRow->active) {
                $link = new WorkflowFancyboxHyperlink($row);
                $link->filename = $documentRow->document->getFilename();
                $link->url = $documentRow->document->getUrl();

                $row->addText($documentRow->getModelValue($externalModel->dateTimeCreated));
                $row->addText($documentRow->getModelValue($externalModel->userCreated->displayName));

                $site = clone(DocumentDeleteSite::$site);
                $site->addParameter(new WorkflowParameter($this->parentId));
                $site->addParameter(new DocumentParameter($documentRow->id));
                $row->addIconSite($site);


            } else {
                $stroke = new Strike($row);
                $stroke->content = $documentRow->document->getFilename();

                $row->addEmpty();
                $row->addEmpty();
                $row->addEmpty();

            }

        }

        /*if ($reader->getCount() == 0) {
            $this->visible = false;
        }*/

        return parent::getContent();

    }

}