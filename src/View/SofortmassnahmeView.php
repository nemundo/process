<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Directory\TextDirectory;
use Schleuniger\App\ChangeRequest\Data\Sofortmassnahme\SofortmassnahmeReader;
use Schleuniger\App\ChangeRequest\Data\SofortmassnahmeInformation\SofortmassnahmeInformationReader;
use Nemundo\Process\Status\Ecr\SofortmassnahmeStatus;

class SofortmassnahmeView extends AbstractChangeRequestView
{

    protected function loadView()
    {
        $this->status = new SofortmassnahmeStatus();
    }


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Sofortmassnahme');
        $header->addText('Information an');

        $sofortmassnahmeReader = new SofortmassnahmeReader();
        $sofortmassnahmeReader->model->loadSofortmassnahmeTyp();
        $sofortmassnahmeReader->filter->andEqual($sofortmassnahmeReader->model->ecrId, $this->workflowId);
        $sofortmassnahmeReader->addOrder($sofortmassnahmeReader->model->sofortmassnahmeTyp->sofortmassnahme);
        foreach ($sofortmassnahmeReader->getData() as $sofortmassnahmeRow) {

            $row = new TableRow($table);
            //$text = $sofortmassnahmeRow->sofortmassnahmeTyp->sofortmassnahme;

            /*if ($sofortmassnahmeRow->erforderlich) {
                $text .= ' ist erforderlich';
            } else {
                $text .= ' ist nicht erforderlich';
            }*/
            $row->addText($sofortmassnahmeRow->sofortmassnahmeTyp->sofortmassnahme);

            $information = new TextDirectory();

            $informationReader = new SofortmassnahmeInformationReader();
            $informationReader->model->loadMitarbeiter();
            $informationReader->filter->andEqual($informationReader->model->sofortmassnahmeId, $sofortmassnahmeRow->id);
            foreach ($informationReader->getData() as $informationRow) {
                $information->addValue($informationRow->mitarbeiter->getDisplayName());
            }
            $row->addText($information->getText());
            //$row->addText($sofortmassnahmeRow->information->displayName);

        }

        return parent::getContent();

    }

}