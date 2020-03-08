<?php


namespace Nemundo\Process\Relation\Type;


use Nemundo\Process\Relation\Data\Relation\Relation;

trait RelationTypeTrait
{


    public function addRelation($contentId) {


        $data = new Relation();
        $data->ignoreIfExists=true;
        $data->fromId = $this->getContentId();
        $data->toId = $contentId;
        $data->save();

        $data = new Relation();
        $data->ignoreIfExists=true;
        $data->fromId = $contentId;
        $data->toId = $this->getContentId();
        $data->save();


    }


    public function deleteRelation() {

    }


    public function getRelationList() {

    }

}