<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\App\Content\Data\ContentLog\ContentLogReader;
use Nemundo\App\Content\Parameter\DataIdParameter;
use Nemundo\Package\FontAwesome\Icon\DeleteIcon;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Builder\StatusLogBuilder;
use Nemundo\Process\Builder\WorkflowLogBuilder;
use Nemundo\Process\Item\WorkflowItem;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Template\Data\Document\DocumentUpdate;
use Nemundo\Process\Template\Parameter\DocumentParameter;
use Nemundo\Process\Template\Status\DocumentDeleteStatus;
use Nemundo\Web\Url\UrlReferer;
use Nemundo\Workflow\App\WorkflowTemplate\Content\Type\File\FileDeleteTemplateStatus;
use Nemundo\Workflow\App\WorkflowTemplate\Data\File\FileUpdate;
use Nemundo\Workflow\App\WorkflowTemplate\Parameter\FileParameter;


class DocumentDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var DocumentDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'delete-file';
        $this->menuActive = false;
    }

    protected function registerSite()
    {
        DocumentDeleteSite::$site = $this;
    }

    public function loadContent()
    {

        $documentId = (new DocumentParameter())->getValue();
        $workflowId =(new WorkflowParameter())->getValue();

        $update = new DocumentUpdate();
        $update->active =false;
        $update->updateById($documentId);


        $builder = new StatusLogBuilder($workflowId);
        $builder->status =new DocumentDeleteStatus();
        $builder->dataId=$documentId;
        $builder->saveStatus();

        //$workflowBuilder->workflowId = $workflowId;
        //$workflowBuilder->dataId = $this->dataId;

        /*
        $workflowBuilder = new DocumentDeleteStatus();  // new WorkflowLogBuilder();
        //$workflowBuilder->status =new DocumentDeleteStatus();
        $workflowBuilder->workflowId = $workflowId;
        //$workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveLog();*/



        //$item = new WorkflowItem($workflowId);
        //$item->



        /*
        $fileId = (new FileParameter())->getValue();
        $dataId = (new DataIdParameter())->getValue();

        $update = new FileUpdate();
        $update->delete = true;
        $update->updateById($fileId);

        $reader = new ContentLogReader();
        $reader->filter->andEqual($reader->model->dataId, $dataId);
        $row = $reader->getRow();

        $contentType = $row->contentType->getContentTypeClassObject();
        $contentType->dataId = $dataId;

        $status = new FileDeleteTemplateStatus();
        $status->dataId = $fileId;
        $status->parentContentType = $contentType;
        $status->saveType();*/

        (new UrlReferer())->redirect();

    }

}