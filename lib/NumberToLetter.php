<?php

class NumberToLetter{
	
	public function numToLetter($nombre, $unite, $plural = true)
    {
        $intVal = intval($nombre);
        $decimal = intval(($nombre - $intVal) * 100);

        return ($this->toLetter($nombre) . ' '. $unite . ($plural && intval($nombre) > 1 ? 's ' : ' ') . ($decimal == 0 ? '' : $this->toLetter($decimal)));
    }

    private function toLetter($nombre)
    {
        if($nombre < 100)
            return $this->centaine($nombre);
        else{
            if($nombre < 1000){
                $d = intval($nombre / 100);
                $r = $nombre - $d * 100;

                return ($d == 1 ? '' : $this->toLetter($d)) . " cent" . (($r == 0 && $d > 1) ? "s " : " ") . $this->toLetter($r);
            }
            elseif($nombre < 1000000){
                $d = intval($nombre / 1000);
                $r = $nombre - $d * 1000;

                return ($d == 1 ? '' : $this->toLetter($d) . ' mille ' . $this->toLetter($r));
            }elseif($nombre < 1000000000){
                $d = intval($nombre / 1000000);
                $r = $nombre - $d * 1000000;

                return $this->toLetter($d) . ' million' . ($d > 1 ? 's ' : ' ') . $this->toLetter($r);
            }elseif($nombre < 1000000000000){
                $d = intval($nombre / 1000000000);
                $r = $nombre - $d * 1000000000;

                return $this->toLetter($d) . ' milliard' . ($d > 1 ? 's ' : ' ') . $this->toLetter($r);
            }
        }
    }

    private function centaine($nombre)
    {
        if($nombre < 20)
            return $this->unite[$nombre];
        elseif($nombre < 100){
            $d = intval($nombre / 10);
            $d = (($d == 7) ? 6 : $d);
            $d = (($d == 9) ? 8 : $d);

            $r = $nombre - $d * 10;
            return $this->dizaine[$d] . ((($r == 1 || $r == 11) && $d != 8) ? " et " : ($r == 0 ? " " : "-")) . $this->unite[$r];
        }
    }
}