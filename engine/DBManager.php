<?php

//include("./obj/KsiegaGosci_obj.php");

class DBManager {

    var $sciezkaPlikuBazy = "../database/wpisy.txt";

    public function zapiszDoBazy($obj) {
        if (file_exists($this->sciezkaPlikuBazy)) {
            $myfile = fopen($this->sciezkaPlikuBazy, "a");

            $myJSON = json_encode($obj);
            fwrite($myfile, $myJSON);
            fwrite($myfile, "\r\n");
            fclose($myfile);
        } else {
            $this->truncateKsiegaGosci();
        }
    }

    private function truncateKsiegaGosci() {
        $myfile = fopen($this->sciezkaPlikuBazy, "w");
        fclose($myfile);
    }

    public function usunZBazyRekord($idWpis) {
        $objArray = $this->odczytajZBazyWszystkie();
        $this->truncateKsiegaGosci();
        foreach ($objArray as $obj) {
            if ($obj->getWpisId() != "$idWpis") {
                $this->zapiszDoBazy($obj);
            }
        }
    }

    public function odczytajZBazyWszystkie() {
        $array = [];
        $wiersz = "";
        if (file_exists($this->sciezkaPlikuBazy)) {
            $myfile = fopen($this->sciezkaPlikuBazy, "r");

            while (!feof($myfile)) {
                $wiersz = fgets($myfile);
                $objRet = $this->getJsonWiersz($wiersz);
                if ($objRet != "ERR") {
                    $array[] = $objRet;
                }
            }

            fclose($myfile);
        } else {
            $this->truncateKsiegaGosci();
        }
        return $array;
    }

    public function odczytajZBazy($wpisID) {

        $wiersz = "";
        if (file_exists($this->sciezkaPlikuBazy)) {
            $myfile = fopen($this->sciezkaPlikuBazy, "r");

            while (!feof($myfile)) {
                $wiersz = fgets($myfile);
                $objRet = $this->getJsonWiersz($wiersz);
                if ($objRet != "ERR") {
                    if ($objRet->getWpisId() == $wpisID) {
                        fclose($myfile);
                        return $objRet;
                    }
                }
            }

            fclose($myfile);
        } else {
            $this->truncateKsiegaGosci();
        }
        return "RECORD_NOT_FOUND";
    }

    private function getJsonWiersz($wiersz) {
        //echo $wiersz;
        try {
            $obj = json_decode($wiersz);
            if (!empty($obj->wpisId) &&
                    !empty($obj->wpisData) &&
                    !empty($obj->wpisNazwaWpisujacego) &&
                    !empty($obj->wpisTrescWpisu)) {
                $objReturn = new KsiegaGosci_obj($obj->{'wpisId'}, $obj->{'wpisData'}, $obj->{'wpisNazwaWpisujacego'}, $obj->{'wpisTrescWpisu'});
                return $objReturn;
            }
        } catch (Exception $e) {
            //echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return "ERR";
    }

}
