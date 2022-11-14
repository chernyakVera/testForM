<?php

namespace src\Services;

use src\Models\User;

class JsonDb
{
    public static function create(User $user)
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);
        $userArray = [
                'login' => $user->getLogin(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
                'authToken' => $user->getAuthToken()
        ];

        if ($tempArrayFromDb === null) {
            $jsonDataToDb = json_encode($userArray);
            file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json', $jsonDataToDb);
        } else {
            array_push($tempArrayFromDb, $userArray);
            $jsonDataToDb = json_encode($tempArrayFromDb);
            file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json', $jsonDataToDb);
        }

    }


    public static function read(string $userLogin, string $category): ?string
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);

        foreach ($tempArrayFromDb as $userArray) {
            if ($userArray['login'] === $userLogin) {
                $foundValueFromDb = $userArray[$category];
                return $foundValueFromDb;
            }
        }
        return null;
    }


    public static function update(string $userLogin, string $category, string $newValue): ?string
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);
        $lengthOfTempArray = count($tempArrayFromDb);

        for ($index = 0; $index < $lengthOfTempArray; $index++ ) {
            if ($tempArrayFromDb[$index]['login'] === $userLogin) {
                $tempArrayFromDb[$index][$category] = $newValue;
                $jsonDataToDb = json_encode($tempArrayFromDb);
                file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json', $jsonDataToDb);
                return $newValue;
            }
        }
        return null;
    }



    public static function isValueExist(string $valueFromPost, string $category): bool
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);

        foreach ($tempArrayFromDb as $userArray) {
                if (key_exists($category, $userArray)) {
                    $matchValue = $userArray[$category];
                    if ($matchValue === $valueFromPost) {
                        return true;
                    }
                }
            }
        return false;
    }


    public static function getUserByLogin(string $userLogin): ?array
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);

        foreach ($tempArrayFromDb as $userArray) {
                if ($userArray['login'] === $userLogin) {
                    return $userArray;
                }
            }
        return null;
    }



    public static function getUserByToken(string $authToken): ?array
    {
        $currentDataFromDb = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'jsonDataBase.json');
        $tempArrayFromDb = json_decode($currentDataFromDb, true);

        foreach ($tempArrayFromDb as $userArray) {
            if ($userArray['authToken'] === $authToken) {
                return $userArray;
            }
        }
        return null;
    }
}