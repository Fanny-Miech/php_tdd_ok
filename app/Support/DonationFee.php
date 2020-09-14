<?php

namespace App\Support;

use Exception;

class DonationFee
{

    private const FIXED_FEE = 50;
    private $donation;
    private $commissionPercentage;

    public function __construct(int $donation, int $commissionPercentage)
    {
        if ($commissionPercentage < 0 || $commissionPercentage > 30)
        {
            throw new Exception("Commission percentage invalid");
        }
        else $this->commissionPercentage = $commissionPercentage;

        if ($donation <= 0)
        {
            throw new Exception("Donation invalid");
        }
        else $this->donation = $donation;
        
    }

    public function getCommissionAmount()
    {
        return $this->donation*$this->commissionPercentage/100;
    }

    public function getAmountCollected()
    {
        return $this->donation-$this->getCommissionAmount();
    }

    public function getFixedAndCommissionFeeAmount()
    {
        return $this->getCommissionAmount() + self::FIXED_FEE;
    }


}