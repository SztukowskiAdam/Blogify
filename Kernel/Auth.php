<?php
namespace Kernel;

use Adapters\UsersAdapter;
use DTO\UsersDTO;
use Models\Users;

class Auth
{
    protected static $usersModel;

    public const NAME_IN_USE = 470;
    public const MAIL_IN_USE = 471;
    public const INVALID_EMAIL = 473;
    public const INVALID_NAME = 474;
    public const INVALID_PASSWORDS = 475;
    public const USER_NOT_FOUND = 476;

    private const MIN_NAME_SIZE = 3;
    private const MAX_NAME_SIZE = 16;
    private const MIN_PASSWORD_SIZE = 7;


    public function __construct() {
        self::$usersModel = new Users();
    }

    /**
     * Method to login
     * @param string $email
     * @param string $password
     * @return Users|null
     */
    public static function attempt(string $email, string $password): ?Users {
        self::$usersModel = new Users();
        if (filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
            if ( strlen($password) > self::MIN_PASSWORD_SIZE) {

                $user = self::$usersModel->where('email', '=', $email);
                if (!empty($user)) {
                    if (password_verify($password, $user[0]['password'])) {
                        self::$usersModel = UsersAdapter::getModelFromArray($user[0]);
                        $_SESSION['user'] = self::$usersModel->id;
                        return self::$usersModel;
                    }
                }
            }
        }
        return null;
    }

    /**
     * Method to get current logged in user
     * @return Users|null
     */
    public static function user(): ?Users {
        if (isset($_SESSION['user'])) {
            $user = new Users();
            return UsersAdapter::getModelFromBasicModel($user->find((int)$_SESSION['user']));
        }
        return null;
    }

    /**
     * Method to validate if user is admin
     * @return bool
     */
    public static function isAdmin(): bool {
        if ($user = self::user()) {
            return $user->isAdmin;
        }
        return false;
    }

    /**
     * Method to register users
     * @param UsersDTO $usersDTO
     * @return int
     */
    public static function register(UsersDTO $usersDTO) {
        self::$usersModel = new Users();

        if (empty(self::$usersModel->where('name', '=', $usersDTO->name))) {
            if (empty(self::$usersModel->where('email', '=', $usersDTO->email))) {
                if (filter_var(filter_var($usersDTO->email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
                    if (strlen($usersDTO->name) > self::MIN_NAME_SIZE && strlen($usersDTO->name) < self::MAX_NAME_SIZE && ctype_alnum($usersDTO->name)) {
                        if ( strlen($usersDTO->password) > self::MIN_PASSWORD_SIZE && $usersDTO->password === $usersDTO->repeatPassword) {
                            $usersDTO->password = password_hash($usersDTO->password, PASSWORD_DEFAULT);
                            $data = [
                                'name' => $usersDTO->name,
                                'email' => $usersDTO->email,
                                'password' => $usersDTO->password,
                                'isAdmin' => false,

                            ];
                            if ($id = self::$usersModel->save($data)) {
                                $_SESSION['user'] = $id;
                                return true;
                            }
                        } else {
                            return self::INVALID_PASSWORDS;
                        }
                    } else {
                        return self::INVALID_NAME;
                    }
                } else {
                    return self::INVALID_EMAIL;
                }
            } else {
                return self::MAIL_IN_USE;
            }
        } else {
            return self::NAME_IN_USE;
        }
    }
}