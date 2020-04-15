<?php


namespace Nemundo\Process\Group\Content;


use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Type\AbstractGroupContentType;

class GroupContentView extends AbstractContentView
{

    /**
     * @var AbstractGroupContentType
     */
    public $contentType;

    public function getContent()
    {


        $title = new AdminTitle($this);
        $title->content = 'GROUP VIEW';


        $groupId = $this->contentType->getDataId();  //getGroupId();

        $p=new Paragraph($this);
        $p->content='Group Id: '.$groupId;

        $groupRow=(new GroupReader())->getRowById($groupId);  // $this->dataId);

        $p=new Paragraph($this);
        $p->content=$groupRow->group.' ('.$this->contentType->typeLabel.')';


        $subtitle=new AdminSubtitle($this);
        $subtitle->content='User';

        $ul=new UnorderedList($this);

/*
        $reader=new GroupUserReader();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->groupId, $groupId);  // $this->dataId);
        foreach ($reader->getData() as $groupUserRow) {
            $ul->addText($groupUserRow->user->displayName);
        }*/


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}