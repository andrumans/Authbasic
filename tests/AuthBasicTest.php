<?php

use PHPUnit\Framework\TestCase;
require "AuthBasicR.php";

class AuthBasicRTest extends TestCase
{
    public function setUp(): void{
        $this->instance = new AuthBasicR();

    }

    public function tearDown(): void{
        unset($this->instance);
    }

    private function testcreateCode(){
        //DEFAULT
        $out = $this->instance->testcreateCode();
        $len = strlen($out);
        fwrite(STDERR, print_r($out, true));
        $this->assertIsNumeric($out, 'Wylosowano: ' .$out);
        $this->assertEquals(6,$len, 'Długość: ' .$len);
        //DŁ 4
        $out = $this->instance->testcreateCode(4,1,9999);
        $len = strlen($out);
        fwrite(STDERR, print_r($out, true));
        $this->assertIsNumeric($out, 'Wylosowano: ' .$out);
        $this->assertEquals(4,$len, 'Długość: ' .$len);

        //DŁ6
        $out = $this->instance->testcreateCode(6,1,999999);
        $len = strlen($out);
        fwrite(STDERR, print_r($out, true));
        $this->assertIsNumeric($out, 'Wylosowano: ' .$out);
        $this->assertEquals(6,$len, 'Długość: ' .$len);
    }

    private function testcreateAuthToken(){
        $token = array(
            "emlAuth"=>'example@ecxample.com', "authCode"=>'141414', "authDate"=>date("Y-m-d"), "authHour"=>date("H-i-s"),
            "addrIp"=> '127.0.0.1',"reqOs"=> 'Linux', "reqBrw"=> 'Vivaldi'
        );
        $out = $this-> instance->createAuthToken("example@example.com", 1);
        $this->assertEquals($token,$out,'Tablice są różne');
    }


}
