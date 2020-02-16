<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\View\AbstractContentAdmin;
use Nemundo\User\Data\User\UserReader;

class UserContentAdmin extends AbstractContentAdmin
{

    protected function loadIndex()
    {

        $table = new AdminTable($this);

        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {

            $row = new TableRow($table);
            $row->addText($userRow->login);

        }




    }

}