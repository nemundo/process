<?php


namespace Nemundo\Process\App\Dashboard\Com\ListBox;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Dashboard\Data\Dashboard\DashboardReader;

class DashboardListBox extends BootstrapListBox
{

    public function getContent()
    {

        $this->label = 'Dashboard Type';

        $reader = new DashboardReader();
        $reader->model->loadContent();
        $reader->addOrder($reader->model->content->subject);
        foreach ($reader->getData() as $dashboardRow) {
            $this->addItem($dashboardRow->contentId, $dashboardRow->content->subject);
        }

        return parent::getContent();

    }

}