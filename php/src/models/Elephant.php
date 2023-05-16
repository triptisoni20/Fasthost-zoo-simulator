<?php

namespace src\models;

use JsonSerializable;

class Elephant implements JsonSerializable
{
    protected string $_title;
    protected float $_health;
    protected bool $_isAlive;
    protected bool $_isDisabled;

    public function setTitle( $title ): void
    {
        $this->_title = $title;
    }
    public function setCurrentHealth( $health ): void
    {
        $this->_health = $health;
    }
    public function setIsAlive( $isAlive ): void
    {
        $this->_isAlive = $isAlive;
    }
    public function setIsDisabled( $isDisabled ): void
    {
        $this->_isDisabled = $isDisabled;
    }

    public function getTitle() {
        return $this->_title;
    }
    public function getCurrentHealth() {
        return $this->_health;
    }
    public function getIsAlive() {
        return $this->_isAlive;
    }
    public function getIsDisabled() {
        return $this->_isDisabled;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->_title,
            'health' => $this->_health,
            'isAlive' => $this->_isAlive,
            'isDisabled' => $this->_isDisabled
        ];
    }
}