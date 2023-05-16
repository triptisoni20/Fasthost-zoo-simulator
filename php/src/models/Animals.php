<?php

namespace src\models;


include_once (__DIR__."/../models/Elephant.php");
include_once (__DIR__."/../models/Giraffe.php");
include_once (__DIR__."/../models/Monkey.php");

class Animals
{
    //variables
    private array $monkeys = array();
    private array $giraffes = array();
    private array $elephants = array();

    //constructor
    public function __construct()
    {
        //for loop with 5 iterations
        for ($i = 0; $i < 5; $i++) {
            //create new monkey
            $monkey = new Monkey();
            //set title
            $monkey->setTitle($this->randomString());
            //set health
            $monkey->setCurrentHealth(100);
            //set isAlive
            $monkey->setIsAlive(true);
            //push monkey to array
            $this->monkeys[] = $monkey;

            //create new giraffe
            $giraffe = new Giraffe();
            //set title
            $giraffe->setTitle($this->randomString());
            //set health
            $giraffe->setCurrentHealth(100);
            //set isAlive
            $giraffe->setIsAlive(true);
            //push giraffe to array
            $this->giraffes[] = $giraffe;

            //create new elephant
            $elephant = new Elephant();
            //set title
            $elephant->setTitle($this->randomString());
            //set health
            $elephant->setCurrentHealth(100);
            //set isAlive
            $elephant->setIsAlive(true);
            //set isDisabled
            $elephant->setIsDisabled(false);
            //push elephant to array
            $this->elephants[] = $elephant;
        }
    }

    //function to create a random string of length less than 10 starting with a capital letter with the rest being lowercase
    private function randomString(): string
    {
        //create a random string of length less than 10 starting with a capital letter with the rest being lowercase
        return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, rand(1, 9));
    }

    /**
     * @return array
     */
    public function getMonkeys(): array
    {
        return $this->monkeys;
    }

    /**
     * @return array
     */
    public function getGiraffes(): array
    {
        return $this->giraffes;
    }

    /**
     * @return array
     */
    public function getElephants(): array
    {
        return $this->elephants;
    }

}