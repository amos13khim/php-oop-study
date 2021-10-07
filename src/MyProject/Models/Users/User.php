<?php
namespace MyProject\Models\Users;
use \MyProject\Models\ActiveRecordEntity;
class User extends ActiveRecordEntity
{
    /** @var string */
    protected $nickname;

    /** @var string */
    protected $email;

    /** @var int */
    protected $isConfirmed;

    /** @var string */
    protected $role;

    /** @var string */
    protected $passwordHash;

    /** @var string */
    protected $authToken;

    /** @var string */
    protected $createdAt;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getIsConfirmed() : int
    {
        return $this->isConfirmed;
    }

    public function getRole() : string
    {
        return $this->role;
    }


    protected static function getTableName(): string
    {
        return 'users';
    }
}