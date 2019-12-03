<?php


namespace Nemundo\Process\View;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Hyperlink\Hyperlink;
use Schleuniger\App\ChangeRequest\Data\Dokument\DokumentReader;
use Schleuniger\App\ChangeRequest\Data\Kommentar\KommentarReader;
use Nemundo\Process\Status\KommentarStatus;

class KommentarView extends AbstractChangeRequestView
{

    protected function loadView()
    {

        $this->status = new KommentarStatus();
    }


    public function getContent()
    {

        //$subtitle = new AdminSubtitle($this);
        //$subtitle->content = 'Kommentar';



        $table = new AdminTable($this);

        $reader = new KommentarReader();
        //$reader->model->loadWorkflowLog();
        //$reader->model->workflowLog->loadMitarbeiter();
//        $reader->filter->andEqual($reader->model->dataId, $this->dataId);
  //      $reader->filter->andEqual($reader->model->workflowLog->workflowId, $this->workflowId);

        foreach ($reader->getData() as $kommentarRow) {

            $row = new TableRow($table);
          //  $row->addText($kommentarRow->workflowLog->mitarbeiter->getDisplayName());
          //  $row->addText($kommentarRow->workflowLog->dateTime->getShortDateTimeFormat());

            $row->addText($kommentarRow->kommentar);

        }

        /*
        if ($reader->getCount() == 0) {
            $this->visible = false;
        }*/

        return parent::getContent();

    }

}