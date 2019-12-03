<?php

namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\FontAwesome\Icon\EditIcon;
use Schleuniger\App\ChangeRequest\Data\Auftrag\AuftragModel;
use Schleuniger\App\ChangeRequest\Data\Auftrag\AuftragReader;
use Schleuniger\App\ChangeRequest\Data\AuftragTaetigkeit\AuftragTaetigkeitReader;
use Schleuniger\App\ChangeRequest\Format\AuftragFormat;
use Schleuniger\App\ChangeRequest\Parameter\AuftragParameter;
use Schleuniger\App\ChangeRequest\Parameter\EcoParameter;
use Schleuniger\App\ChangeRequest\Parameter\StatusParameter;
use Schleuniger\App\ChangeRequest\Site\Auftrag\AuftragAbschliessenSite;
use Schleuniger\App\ChangeRequest\Site\Auftrag\AuftragDeleteSite;
use Schleuniger\App\ChangeRequest\Site\Eco\EcoItemSite;
use Nemundo\Process\Builder\WorkflowBuilder;
use Nemundo\Process\Status\Eco\AuftragStatus;

class AuftragView extends AbstractChangeRequestView
{


    protected function loadView()
    {
        // TODO: Implement loadView() method.
        $this->status = new AuftragStatus();
    }


    public function getContent()
    {


        $workflowBuilder = new WorkflowBuilder($this->workflowId);
        $ecoId = $workflowBuilder->getEcoId();


        $auftragModel = new AuftragModel();

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addEmpty();
        $header->addText($auftragModel->abgeschlossen->label);

        $header->addEmpty();
        $header->addEmpty();
        $header->addEmpty();


        $auftragReader = new AuftragReader();
        $auftragReader->filter->andEqual($auftragReader->model->ecoId, $ecoId);
        foreach ($auftragReader->getData() as $auftragRow) {

            $row = new TableRow($table);

            $div = new Div($row);

            $p = new Paragraph($div);
            $p->content = (new AuftragFormat())->getFormat($auftragRow);


            $list = new UnorderedList($div);

            $auftragTaetigkeitReader = new AuftragTaetigkeitReader();
            $auftragTaetigkeitReader->model->loadTaetigkeit();
            $auftragTaetigkeitReader->filter->andEqual($auftragTaetigkeitReader->model->auftragId, $auftragRow->id);
            foreach ($auftragTaetigkeitReader->getData() as $auftragTaetigkeitRow) {
                $list->addText($auftragTaetigkeitRow->taetigkeit->taetigkeit);
            }

            $row->addYesNo($auftragRow->abgeschlossen);



            if (!$auftragRow->abgeschlossen) {

                $site = clone(EcoItemSite::$site);
                $site->addParameter(new EcoParameter());
                $site->addParameter(new StatusParameter((new AuftragStatus())->id));
                $site->addParameter(new AuftragParameter($auftragRow->id));
                $row->addHyperlinkIcon(new EditIcon(), $site);

                $site = clone(AuftragAbschliessenSite::$site);
                $site->addParameter(new AuftragParameter($auftragRow->id));
                $row->addIconSite($site);

                $site = clone(AuftragDeleteSite::$site);
                $site->addParameter(new AuftragParameter($auftragRow->id));
                $row->addIconSite($site);

            } else {

                $row->addEmpty();
                $row->addEmpty();
                $row->addEmpty();

            }

        }

        return parent::getContent();

    }

}