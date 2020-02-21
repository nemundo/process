<?php
namespace Nemundo\Process\App\Contact\Data\Contact;
class ContactExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $company;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $lastName;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $firstName;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $phone;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $email;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = ContactModel::class;
$this->externalTableName = "contact_contact";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->company = new \Nemundo\Model\Type\Text\TextType();
$this->company->fieldName = "company";
$this->company->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->company->aliasFieldName = $this->company->tableName . "_" . $this->company->fieldName;
$this->company->label = "Company";
$this->addType($this->company);

$this->lastName = new \Nemundo\Model\Type\Text\TextType();
$this->lastName->fieldName = "last_name";
$this->lastName->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->lastName->aliasFieldName = $this->lastName->tableName . "_" . $this->lastName->fieldName;
$this->lastName->label = "Last Name";
$this->addType($this->lastName);

$this->firstName = new \Nemundo\Model\Type\Text\TextType();
$this->firstName->fieldName = "first_name";
$this->firstName->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->firstName->aliasFieldName = $this->firstName->tableName . "_" . $this->firstName->fieldName;
$this->firstName->label = "First Name";
$this->addType($this->firstName);

$this->phone = new \Nemundo\Model\Type\Text\TextType();
$this->phone->fieldName = "phone";
$this->phone->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->phone->aliasFieldName = $this->phone->tableName . "_" . $this->phone->fieldName;
$this->phone->label = "Phone";
$this->addType($this->phone);

$this->email = new \Nemundo\Model\Type\Text\TextType();
$this->email->fieldName = "email";
$this->email->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->email->aliasFieldName = $this->email->tableName . "_" . $this->email->fieldName;
$this->email->label = "eMail";
$this->addType($this->email);

}
}