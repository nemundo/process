<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\View\AbstractContentAdmin;
use Nemundo\User\Data\User\UserPaginationReader;

class UserContentAdmin extends AbstractContentAdmin
{

    protected function loadIndex()
    {

        $userReader = new UserPaginationReader();
        $userReader->addOrder($userReader->model->displayName);
        $userReader->paginationLimit=ProcessConfig::PAGINATION_LIMIT;


        $table = new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText($userReader->model->login->label);
        $header->addText($userReader->model->displayName->label);
        $header->addText($userReader->model->email->label);


        foreach ($userReader->getData() as $userRow) {

            $row = new TableRow($table);
            $row->addText($userRow->login);
            $row->addText($userRow->displayName);
            $row->addText($userRow->email);

        }

        $pagination = new BootstrapPagination($this);
        $pagination->paginationReader = $userReader;


    }

}