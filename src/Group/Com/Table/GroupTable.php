<?php


namespace Nemundo\Process\Group\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Web\Site\Site;

class GroupTable extends AdminClickableTable
{

    /**
     * @var AbstractGroupContentType
     */
    public $groupContentType;

    public $showGroupType = true;

    public function getContent()
    {

        $header = new AdminTableHeader($this);

        $cell = new Th($header);
        $cell->content[LanguageCode::EN] = 'Group';
        $cell->content[LanguageCode::DE] = 'Gruppe';

        if ($this->showGroupType) {
            $cell = new Th($header);
            $cell->content[LanguageCode::EN] = 'Group Type';
            $cell->content[LanguageCode::DE] = 'Gruppe Typ';
        }

        $groupReader = new GroupReader();
        $groupReader->model->loadGroupType();

        if ($this->groupContentType !== null) {
            $groupReader->filter->andEqual($groupReader->model->groupTypeId, $this->groupContentType->typeId);
        }

        $groupReader->addOrder($groupReader->model->group);
        foreach ($groupReader->getData() as $groupRow) {
            $row = new BootstrapClickableTableRow($this);
            $row->addText($groupRow->group);

            if ($this->showGroupType) {
                $row->addText($groupRow->groupType->contentType);
            }

            $site = new Site();  // clone(GroupSite::$site);
            $site->addParameter(new GroupParameter($groupRow->id));
            $row->addClickableSite($site);

        }

        return parent::getContent();

    }

}