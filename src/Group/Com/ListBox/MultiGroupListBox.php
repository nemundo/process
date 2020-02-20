<?php


namespace Nemundo\Process\Group\Com\ListBox;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Group\Com\GroupContentTypeTrait;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Parameter\GroupParameter;

class MultiGroupListBox extends BootstrapListBox
{

    use GroupContentTypeTrait;

    /**
     * @var bool
     */
    public $showGroupTypeTitle = true;

    protected function loadContainer()
    {

        parent::loadContainer();

        $this->label[LanguageCode::EN] = 'Group';
        $this->label[LanguageCode::DE] = 'Gruppe';
        $this->name = (new GroupParameter())->getParameterName();

    }


    public function getContent()
    {

        foreach ($this->groupContentTypeList as $groupContentType) {

            if ($this->showGroupTypeTitle) {
                $this->addItemTitle($groupContentType->typeLabel);
            }

            $groupReader = new GroupReader();
            $groupReader->filter->andEqual($groupReader->model->groupTypeId, $groupContentType->typeId);
            $groupReader->filter->andEqual($groupReader->model->active,true);

            $groupReader->addOrder($groupReader->model->group);
            foreach ($groupReader->getData() as $groupRow) {
                $this->addItem($groupRow->id, $groupRow->group);
            }

        }

        return parent::getContent();

    }


}