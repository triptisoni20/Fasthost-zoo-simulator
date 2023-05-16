<?php

namespace src\models;

use JsonSerializable;

class Monkey implements JsonSerializable
{
    protected string $_title;
    protected float $_health;
    protected bool $_isAlive;

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

    public function getTitle() {
        return $this->_title;
    }
    public function getCurrentHealth() {
        return $this->_health;
    }
    public function getIsAlive() {
        return $this->_isAlive;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->_title,
            'health' => $this->_health,
            'isAlive' => $this->_isAlive
        ];
    }
}