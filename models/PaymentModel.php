<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class PaymentModel extends Model
{
    protected $primaryKey = "paymentId";

    public function getUnusedPaidOneByUserId($userId)
    {
        $c = new Criteria();
        $c->add("userId", $userId);
        return $this->getUnusedPaidOne($c);
    }

    public function getUnusedPaidOne($c)
    {
        $c2 = new Criteria();
        $c2->add("status", "paid");
        $c2->addOr("status", "pending");
        $c->add($c2);
        $c->add("used", 0);
        $c->addOrder("paymentId");
        return $this->find($c);
    }

    public function getUnusedPaidOneByIp($ip)
    {
        $c = new Criteria();
        $c->add("ip", $ip);
        return $this->getUnusedPaidOne($c);
    }
}

class PaymentRecord extends ModelRecord
{
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function save()
    {
        if (!empty($this->siteId)) {
            $site = Model::factoryInstance("site")->findByPk($this->siteId);

            if ($site) {
                $site->paymentStatus = $this->status;

                if ($this->status == "paid" && Config::get("automaticSiteValidation")) {
                    $site->status = "validated";
                }

                $site->save();
            }
        }

        parent::save();
    }
}
