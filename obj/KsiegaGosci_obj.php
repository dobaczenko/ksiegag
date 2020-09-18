<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class KsiegaGosci_obj {

    private $wpisId;
    private $wpisData;
    private $wpisNazwaWpisujacego;
    private $wpisTrescWpisu;

    function __construct($wpisId, $wpisData, $wpisNazwaWpisujacego, $wpisTrescWpisu) {
        $this->wpisId = $wpisId;
        $this->wpisData = $wpisData;
        $this->wpisNazwaWpisujacego = $wpisNazwaWpisujacego;
        $this->wpisTrescWpisu = $wpisTrescWpisu;
    }

    function getWpisData() {
        return $this->wpisData;
    }

    function getWpisNazwaWpisujacego() {
        return $this->wpisNazwaWpisujacego;
    }

    function getWpisTrescWpisu() {
        return $this->wpisTrescWpisu;
    }

    function setWpisData($wpisData): void {
        $this->wpisData = $wpisData;
    }

    function setWpisNazwaWpisujacego($wpisNazwaWpisujacego): void {
        $this->wpisNazwaWpisujacego = $wpisNazwaWpisujacego;
    }

    function setWpisTrescWpisu($wpisTrescWpisu): void {
        $this->wpisTrescWpisu = $wpisTrescWpisu;
    }

    function getWpisId() {
        return $this->wpisId;
    }

    function setWpisId($wpisId): void {
        $this->wpisId = $wpisId;
    }

}
