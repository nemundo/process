<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Process\Content\Type\AbstractTreeContentType;

abstract class AbstractGroupContentType extends AbstractTreeContentType
{

    use GroupIndexTrait;


    protected $group;


    public function __construct($dataId = null)
    {

        parent::__construct($dataId);
        $this->loadGroup();

    }

    protected function loadGroup() {

    }


    protected function onIndex()
    {

        parent::onIndex();
        $this->saveGroupIndex();

    }


    protected function getGroupLabel()
    {

        return $this->group;

    }



    /*
    protected $group;

    protected $groupId;

    /**
     * @var bool
     */
    //protected $searchable = true;


    /*
    public function __construct($dataId = null)
    {

        $this->typeLabel = 'Content Group';
        $this->typeId = '8fb75394-3e0d-4a3e-a209-1a5ebfc46220';
        $this->formClass = GroupContentForm::class;

        $this->loadGroup();

        parent::__construct($dataId);

    }


    public function fromGroupId($groupId)
    {

        $this->groupId = $groupId;
        return $this;

    }


    protected function loadGroup()
    {

    }


    protected function onCreate()
    {
        // nach saveType


        $this->saveGroup();

    }


    protected function saveGroup()
    {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $this->getGroupId();
        $data->active = true;
        $data->group = $this->getGroupLabel();
        $data->groupTypeId = $this->typeId;
        $data->save();

    }


    protected function onIndex()
    {

        parent::onIndex();

        /*if ($this->searchable) {
            $groupRow = $this->getGroupDataRow();
            $this->addSearchWord($groupRow->group);
        }*/

    //}


    // nach public deleteType
    /* protected function onDelete()
     {

         if ($this->groupId == null) {
             (new Debug())->write('no group id');
         }

         //(new GroupDelete())->deleteById($this->dataId);
         (new GroupDelete())->deleteById($this->groupId);

     }


     protected function onActive()
     {
         $update = new GroupUpdate();
         $update->active = true;
         $update->updateById($this->dataId);
     }


     protected function onInactive()
     {
         $update = new GroupUpdate();
         $update->active = false;
         $update->updateById($this->dataId);

     }


     protected function getGroupLabel()
     {

         $group = $this->group;
         if ($group == null) {
             $group = $this->getClassName();
         }

         return $group;

     }


     public function getGroupId()
     {

         if ($this->groupId == null) {
             $this->groupId = (new UniqueId())->getUniqueId();
         }

         return $this->groupId;

     }


     public function getGroupDataRow()
     {

         if ($this->groupId == null) {
             (new Debug())->write('no group id');
         }

         $reader = new GroupReader();
         $reader->model->loadGroupType();
         $row = $reader->getRowById($this->groupId);

         return $row;
     }


     public function getSubject()
     {

         return $this->getGroupLabel();

     }


     public function addUser($userId)
     {

         $data = new GroupUser();
         $data->ignoreIfExists = true;
         $data->groupId = $this->groupId;
         $data->userId = $userId;
         $data->save();

         return $this;

     }


     public function removeUser($userId)
     {

         $delete = new GroupUserDelete();
         $delete->filter->andEqual($delete->model->groupId, $this->dataId);
         $delete->filter->andEqual($delete->model->userId, $userId);
         $delete->delete();

         return $this;

     }


     public function getUserList()
     {

         /** @var UserCustomRow[] $list */
    /*     $list = [];

         $reader = new GroupUserReader();
         $reader->model->loadUser();
         $reader->filter->andEqual($reader->model->groupId, $this->getGroupId());
         $reader->addOrder($reader->model->user->login);
         foreach ($reader->getData() as $groupUserRow) {
             $list[] = $groupUserRow->user;
         }

         return $list;

     }


     public function getUserIdList()
     {

         $list = [];

         $reader = new GroupUserReader();
         $reader->model->loadUser();
         $reader->filter->andEqual($reader->model->groupId, $this->getGroupId());

         foreach ($reader->getData() as $groupUserRow) {
             $list[] = $groupUserRow->userId;
         }

         return $list;

     }


     public function getUserListText()
     {

         $text = new TextDirectory();

         foreach ($this->getUserList() as $userRow) {
             $text->addValue($userRow->displayName);
         }

         return $text->getTextWithSeperator();

     }


     public function existItem()
     {

         $value = false;

         $count = new GroupCount();
         $count->filter->andEqual($count->model->id, $this->getGroupId());
         if ($count->getCount() > 0) {
             $value = true;
         }

         return $value;

     }*/

}