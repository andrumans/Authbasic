<?php

class AuthBasic
{

    /**
     * generowany token będzie podlegał parametryzacji
     *@param int $length Długość kod - liczba znaków
     *@param int $min Minimalna wartośc dla generowanego numeru
     *@param int $max Maksymalna wartośc dla generowanego kodu
     *@return int Zwraca wygenerowaną na podstawie parametróœ liczbę lub numer który musi zostać uzuzpełniony zerami wiodącymi jeżeli trzeba spełnić długość
     **/
    public function genFingerprint($algo){

    }

    /**
     * @desc --> Dodawaine użytkownika do bd
     * @param string $email adres email użytkownika do uwietrzylniania
     * @param $id numer id użytkownika
     * @return array|false Wygernerowany token lub false
     *
     */
    public function createAuthToken($email, $id){
        $authCode = $this->createCode();
        $authDate = date("Y-m-d");
        $authHour = date("H-i-s");
        $addrIP = '127.0.0.1'; //TODO lib -> IP
        $opSys = 'Linux'; //TODO lib -> whichBrowser
        $browser = 'Vivaldi'; //TODO lib -> whichBrowser

        $token = array(
            "emlAuth"=>$email,
            "authCode"=>$authCode,
            "authDate"=>$authDate,
            "authHour"=>$authHour,
            "addrIp"=> $addrIP,
            "reqOs"=> $opSys,
            "reqBrw"=> $browser
        );
        $tbl = 'cmsWebsiteAuth';
        $file = dirname(__FILE__)."/".$tbl.'.php';
        $fdata = file_put_contents($file.serialize($token));
        $tok = (unserialize($fdata)==$token) ? 0: 'DbErr: 1045';
        $resp = ($tok==0) ? $token : false;

        return $resp;
    }


    public function createCode($length=6, $min=1, $max=999999){
        $max = substr($max, 0,$length);
        return str_pad(mt_rand($min, $max),$length,'0',STR_PAD_LEFT);
    }



}