<?php

class Car {
    private $model;
    private $color;
    private $year;

    public function __construct($model, $color, $year) {
        $this->model = $model;
        $this->color = $color;
        $this->year = $year;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getModel() {
        return $this->model;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getYear() {
        return $this->year;
    }
}

?>