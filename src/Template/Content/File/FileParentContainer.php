<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Formatting\Strike;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\FileDeleteSite;
use Nemundo\Process\Template\Status\DocumentProcessStatus;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Workflow\App\WorkflowTemplate\Com\WorkflowFancyboxHyperlink;


class FileParentContainer extends AbstractParentContainer
{

    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Dokument');
        $header->addText('Ersteller');
        $header->addEmpty();

        $fileReader =new TemplateFileReader();
        $fileReader->model->loadContent();
        $fileReader->model->content->loadUser();

        $treeModel  = new TreeModel();
        $join=new ModelJoin($fileReader);
        $join->externalModel=$treeModel;
        $join->externalType=$treeModel->childId;
        $join->type = $fileReader->model->contentId;

        $fileReader->filter->andEqual($treeModel->parentId,$this->parentId);


        $fileReader->addOrder($fileReader->model->file->fileName);
        foreach ($fileReader->getData() as $documentRow) {

            $row = new TableRow($table);

            if ($documentRow->active) {
                $link = new WorkflowFancyboxHyperlink($row);
                $link->filename = $documentRow->file->getFilename();
                $link->url = $documentRow->file->getUrl();

                $row->addText($documentRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
                $row->addText($documentRow->content->user->displayName);

                $site = clone(FileDeleteSite::$site);
                $site->addParameter(new ParentParameter($this->parentId));
                $site->addParameter(new FileParameter($documentRow->id));
                $row->addIconSite($site);


            } else {
                $stroke = new Strike($row);
                $stroke->content = $documentRow->file->getFilename();

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