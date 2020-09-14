<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Exception;

class DonationFeeTest extends TestCase
{

    public function testCommissionAmountIs10CentsFormDonationOf100CentsAndCommissionOf10Percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new \App\Support\DonationFee(100, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 10
        $expected = 10;
        $this->assertEquals($expected, $actual);
    }

    public function testCommissionAmountIs20CentsFormDonationOf200CentsAndCommissionOf10Percent()
    {
        // Etant donné une donation de 100 et commission de 10%
        $donationFees = new \App\Support\DonationFee(200, 10);

        // Lorsque qu'on appel la méthode getCommissionAmount()
        $actual = $donationFees->getCommissionAmount();

        // Alors la Valeur de la commission doit être de 20
        $expected = 20;
        $this->assertEquals($expected, $actual);
    }

    public function testAmountCollected()
    {
        //Given
        $donationFees = new \App\Support\DonationFee(100, 10);

        //When
        $actual = $donationFees->getAmountCollected();

        //Then
        $expected = 90;
        $this->assertEquals($expected, $actual);
    }

    public function testExceptionWithCommissionPercentageEquals31()
    {
        $this->expectException('Exception');
    
        $donationFees = new \App\Support\DonationFee(100, 31);
    }

    public function testExceptionDonationIsNull()
    {
        $this->expectException('Exception');
        $donationFees = new \App\Support\DonationFee(0,10);
    }

    public function testTotalFixedAndCommission()
    {
        //given
        $donationFees = new \App\Support\DonationFee(100, 10);

        //when
        $actual = $donationFees->getFixedAndCommissionFeeAmount();

        //then
        $expected = 60;
        $this->assertEquals($expected, $actual);
    }
}
