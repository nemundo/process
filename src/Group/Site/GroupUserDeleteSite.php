<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Parameter\GroupUserParameter;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Core\Http\Url\UrlReferer;

class GroupUserDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var GroupUserDeleteSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'Delete User';
        $this->title[LanguageCode::DE] = 'Benutzer löschen';

        $this->url='group-user-delete';
        GroupUserDeleteSite::$site=$this;
    }


    public function loadContent()
    {

        //$groupId=(new GroupParameter())->getValue();
        //$userId=(new UserParameter())->getValue();

        $groupUserId=(new GroupUserParameter())->getValue();
        (new GroupUserDelete())->deleteById($groupUserId);

        /*$delete = new GroupUserDelete();
        $delete->filter->andEqual($delete->model->groupId,$groupId);
        $delete->filter->andEqual($delete->model->userId,$userId);
        $delete->delete();*/



        (new UrlReferer())->redirect();



        // TODO: Implement loadContent() method.
    }


}