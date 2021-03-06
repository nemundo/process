<?php


namespace Nemundo\Process\App\Dashboard\Com\Form;


use Nemundo\Package\Bootstrap\Form\BootstrapForm;
use Nemundo\Process\App\Dashboard\Com\ListBox\DashboardListBox;
use Nemundo\Process\App\Dashboard\Data\UserDashboard\UserDashboard;
use Nemundo\Process\App\Dashboard\Type\DashboardContentTypeCollection;
use Nemundo\Process\Content\Com\ListBox\ContentTypeCollectionListBox;
use Nemundo\User\Session\UserSession;

class DashboardForm extends BootstrapForm
{

    /**
     * @var ContentTypeCollectionListBox
     */
    private $listbox;

    public function getContent()
    {

        $this->listbox =new DashboardListBox($this);
        //$listbox->contentTypeCollection = new DashboardContentTypeCollection();
        //$listbox->searchMode = true;
        //$listbox->submitOnChange = true;

        $this->submitButton->label='Add';

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        $data = new UserDashboard();
        $data->userId=(new UserSession())->userId;
        $data->dashboardId=$this->listbox->getValue();
        $data->save();

        parent::onSubmit(); // TODO: Change the autogenerated stub
    }


}