<?php

namespace src\controllers;
interface IRequest
{
    public function getAnimals();
    public function getCurrentTime();
    public function fastForwardTime();
    public function feed();
}