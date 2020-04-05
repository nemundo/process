<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Data\Tree\TreeModel;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Data\TemplateFile\TemplateFileReader;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Site\FileInactiveSite;
use Nemundo\Workflow\App\WorkflowTemplate\Com\WorkflowFancyboxHyperlink;


// auslagern in schleuniger repo !!!

class FileParentContainer extends AbstractParentContainer
{

    public $showDeleteButton = true;

    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Dokument');
        $header->addText('Ersteller');

        if ($this->showDeleteButton) {
            $header->addEmpty();
        }

        $fileReader = new TemplateFileReader();
        $fileReader->model->loadContent();
        $fileReader->model->content->loadUser();

        $treeModel = new TreeModel();

        $join = new ModelJoin($fileReader);
        $join->externalModel = $treeModel;
        $join->externalType = $treeModel->childId;
        $join->type = $fileReader->model->contentId;

        $fileReader->filter->andEqual($treeModel->parentId, $this->parentId);

        $fileReader->addOrder($fileReader->model->file->fileName);
        foreach ($fileReader->getData() as $documentRow) {

            $row = new TableRow($table);
            $row->strikeThrough = !$documentRow->active;

            if ($documentRow->active) {
                $link = new WorkflowFancyboxHyperlink($row);
                $link->filename = $documentRow->file->getFilename();
                $link->url = $documentRow->file->getUrl();
            } else {
                $row->addText($documentRow->file->getFilename());
            }

            $ersteller = $documentRow->content->user->login . ' ' . $documentRow->content->dateTime->getShortDateLeadingZeroFormat();
            $row->addText($ersteller, true);

            if ($this->showDeleteButton) {
                if ($documentRow->active) {
                    $site = clone(FileInactiveSite::$site);
                    $site->addParameter(new ParentParameter($this->parentId));
                    $site->addParameter(new FileParameter($documentRow->id));
                    $row->addIconSite($site);
                } else {
                    $row->addEmpty();
                }
            }

        }

        if ($fileReader->getCount() == 0) {
            $this->visible = false;
        }

        return parent::getContent();

    }

}