<?php

namespace Adapters;



use DTO\UsersDTO;
use Kernel\Model;
use Models\Users;

class UsersAdapter
{
    private static $users;
    private static $usersDTO;

    /**
     * Converts UsersDTO into Users class
     * @param UsersDTO $usersDTO
     * @return Users
     */
    public static function getModel(UsersDTO $usersDTO): Users {
        self::$users = new Users();
        self::$usersDTO = $usersDTO;

        self::$users->id = self::$usersDTO->id;
        self::$users->name = self::$usersDTO->name;
        self::$users->password = self::$usersDTO->password;
        self::$users->email = self::$usersDTO->email;
        self::$users->isAdmin = self::$usersDTO->isAdmin;

        if (self::$users->timestamps) {
            self::$users->createdAt = self::$usersDTO->createdAt;
            self::$users->updatedAt = self::$usersDTO->updatedAt;
        }

        return self::$users;
    }

    /**
     * Converts array into Users class
     * @param array $data
     * @return Users
     */
    public static function getModelFromArray(array $data): Users {
        self::$users = new Users();

        array_key_exists('id', $data) ? self::$users->id = $data['id'] : self::$users->id = null;
        array_key_exists('name', $data) ? self::$users->name = $data['name'] : self::$users->name = null;
        array_key_exists('email', $data) ? self::$users->email = $data['email'] : self::$users->email = null;
        array_key_exists('password', $data) ? self::$users->password = $data['password'] : self::$users->password = null;
        array_key_exists('isAdmin', $data) ? self::$users->isAdmin = $data['isAdmin'] : self::$users->isAdmin = null;
        if (self::$users->timestamps) {
            array_key_exists('createdAt', $data) ? self::$users->createdAt = $data['createdAt'] : self::$users->createdAt = null;
            array_key_exists('updatedAt', $data) ? self::$users->updatedAt = $data['updatedAt'] : self::$users->updatedAt = null;
        }

        return self::$users;
    }

    /**
     * Converts Users into UsersDTO class
     * @param Users $users
     * @return UsersDTO
     */
    public static function getModelDTO(Users $users): UsersDTO {
        self::$usersDTO = new UsersDTO();
        self::$users = $users;

        self::$usersDTO->id = self::$users->id;
        self::$usersDTO->name = self::$users->name;
        self::$usersDTO->password = self::$users->password;
        self::$usersDTO->email = self::$users->email;
        self::$usersDTO->isAdmin = self::$users->isAdmin;

        if (self::$users->timestamps) {
            self::$usersDTO->createdAt = self::$users->createdAt;
            self::$usersDTO->updatedAt = self::$users->updatedAt;
        }
        return self::$usersDTO;
    }

    /**
     * Converts Basic Model into Users class
     * @param Model $model
     * @return Users
     */
    public static function getModelFromBasicModel(Model $model): Users {
        self::$users = new Users();

        property_exists($model, 'id') ? self::$users->id = $model->id : self::$users->id = null;
        property_exists($model, 'name') ? self::$users->name = $model->name : self::$users->name = null;
        property_exists($model, 'password') ? self::$users->password = $model->password : self::$users->password = null;
        property_exists($model, 'email') ? self::$users->email = $model->email : self::$users->email = null;
        property_exists($model, 'isAdmin') ? self::$users->isAdmin = $model->isAdmin : self::$users->isAdmin = null;

        if (self::$users->timestamps) {
            property_exists($model, 'createdAt') ? self::$users->createdAt = $model->createdAt : self::$users->createdAt = null;
            property_exists($model, 'updatedAt') ? self::$users->updatedAt = $model->updatedAt : self::$users->updatedAt = null;
        }

        return self::$users;
    }
}