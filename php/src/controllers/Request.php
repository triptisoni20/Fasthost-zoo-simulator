<?php

namespace src\controllers;

use src\models\Animals;

include_once (__DIR__."/../utils/Session.php");
include_once (__DIR__."/../utils/Helpers.php");
include_once (__DIR__."/../models/Animals.php");
include_once (__DIR__."/../controllers/IRequest.php");


/**
 * @property $requestMethod
 */
class Request implements IRequest
{
    function __construct()
    {
        //call session`
        session();

        //call bootstrapSelf
        $this->bootstrapSelf();
    }

    /**
     * @return void
     *
     * Sets all keys in the global $_SERVER array as properties of the Request class and assigns their values as well
     */
    private function bootstrapSelf(): void
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * @param $string
     * @return array|string|string[]
     *
     * Converts a string to camel case
     */
    private function toCamelCase($string): array|string
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * @return bool|array|string
     *
     * Generate and return an initial list of animals
     * This method is used to initialize the application
     * Also, save the animals in the session
     */
    public function getAnimals(): bool|array|string
    {
        //create new instance of Animals
        $animals = new Animals();
        //combine all animals into one array
        $combinedArray = [
            'monkeys' => $animals->getMonkeys(),
            'giraffes' => $animals->getGiraffes(),
            'elephants' => $animals->getElephants(),
        ];
        //set global animals
        $_SESSION['animals'] = $combinedArray;
        //return combined array
        return $combinedArray;
    }

    /**
     * Generate Current Time and return it
     * This method is used to initialize the application
     * Also, save the time in the session
     */
    public function getCurrentTime(): string
    {
        //set timezone
        date_default_timezone_set('Asia/Kolkata');
        //get current time
        $time = date("H:i");
        //set global time
        $_SESSION['time'] = $time;
        //return time
        return $time;
    }

    /**
     *
     * Implementation of the method defined in the IRequest interface.
     * This method is used to fast-forward time in the application
     */
    public function fastForwardTime(): void
    {
        //get global time
        $time = $_SESSION['time'];
        //increment time by 1 hour
        $time = date("H:i", strtotime('+1 hour', strtotime($time)));
        //set global time
        $_SESSION['time'] = $time;

        //get global animals
        $animals = $_SESSION['animals'];
        //get monkeys
        $monkeys = $animals['monkeys'];
        //get giraffes
        $giraffes = $animals['giraffes'];
        //get elephants
        $elephants = $animals['elephants'];

        //loop through monkeys
        foreach ($monkeys as $monkey) {
            //check if monkey is alive
            if ($monkey->getIsAlive()) {
                //get ransom number from function
                $randomNumber = randomNumber();
                //get health from monkey object
                $health = $monkey->getCurrentHealth();
                //get health after decrementing random number as percentage
                $health = $health - ($health * $randomNumber / 100);
                //if health is less than 30%
                if ($health < 30) {
                    //set isAlive to false
                    $monkey->setIsAlive(false);
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $monkey->setCurrentHealth($health);
            }
        }

        //loop through giraffes
        foreach ($giraffes as $giraffe) {
            //check if giraffe is alive
            if ($giraffe->getIsAlive()) {
                //get ransom number from function
                $randomNumber = randomNumber();
                //get health from giraffe object
                $health = $giraffe->getCurrentHealth();
                //get health after decrementing random number as percentage
                $health = $health - ($health * $randomNumber / 100);
                //if health is less than 50%
                if ($health < 50) {
                    //set isAlive to false
                    $giraffe->setIsAlive(false);
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $giraffe->setCurrentHealth($health);
            }
        }

        //loop through elephants
        foreach ($elephants as $elephant) {
            //check if elephant is alive
            if ($elephant->getIsAlive()) {
                //get ransom number from function
                $randomNumber = randomNumber();
                //get health from elephant object
                $health = $elephant->getCurrentHealth();
                //get health after decrementing random number as percentage
                $health = $health - ($health * $randomNumber / 100);
                //if health is less than 70% and isDisabled is false
                if ($health < 70 && $elephant->getIsDisabled() === false) {
                    //set isDisabled to true
                    $elephant->setIsDisabled(true);
                } else if ($health < 70 && $elephant->getIsDisabled() === true) {
                    //set isAlive to false
                    $elephant->setIsAlive(false);
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $elephant->setCurrentHealth($health);
            }
        }

        //update animals array
       $animals = [
            'monkeys' => $monkeys,
            'giraffes' => $giraffes,
            'elephants' => $elephants,
        ];

        //set global animals
        $_SESSION['animals'] = $animals;
    }

    public function feed(): void
    {
        //get global animals
        $animals = $_SESSION['animals'];
        //get monkeys
        $monkeys = $animals['monkeys'];
        //get giraffes
        $giraffes = $animals['giraffes'];
        //get elephants
        $elephants = $animals['elephants'];

        //generate random number
        $randomNumber = randomNumber();
        //loop through monkeys
        foreach ($monkeys as $monkey) {
            //check if monkey is alive
            if ($monkey->getIsAlive()) {
                //get health from monkey object
                $health = $monkey->getCurrentHealth();
                //get health after incrementing by random number as percentage
                $health = $health + ($health * $randomNumber / 100);
                //if health is greater than 100
                if ($health > 100) {
                    //set health to 100
                    $health = 100;
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $monkey->setCurrentHealth($health);
            }
        }

        //generate random number
        $randomNumber = randomNumber();
        //loop through giraffes
        foreach ($giraffes as $giraffe) {
            //check if giraffe is alive
            if ($giraffe->getIsAlive()) {
                //get health from giraffe object
                $health = $giraffe->getCurrentHealth();
                //get health after incrementing by random number as percentage
                $health = $health + ($health * $randomNumber / 100);
                //if health is greater than 100
                if ($health > 100) {
                    //set health to 100
                    $health = 100;
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $giraffe->setCurrentHealth($health);
            }
        }

        //generate random number
        $randomNumber = randomNumber();
        //loop through elephants
        foreach ($elephants as $elephant) {
            //check if elephant is alive
            if ($elephant->getIsAlive()) {
                //get health from elephant object
                $health = $elephant->getCurrentHealth();
                //get health after incrementing by random number as percentage
                $health = $health + ($health * $randomNumber / 100);
                //if health is greater than 70% and isDisabled is true
                if ($health > 70 && $elephant->getIsDisabled() === true) {
                    //set isDisabled to false
                    $elephant->setIsDisabled(false);
                }
                //if health is greater than 100
                if ($health > 100) {
                    //set health to 100
                    $health = 100;
                }
                //convert health to integer
                $health = (int)$health;
                //set health
                $elephant->setCurrentHealth($health);
            }
        }

        //update animals array
        $animals = [
            'monkeys' => $monkeys,
            'giraffes' => $giraffes,
            'elephants' => $elephants,
        ];

        //set global animals
        $_SESSION['animals'] = $animals;
    }
}