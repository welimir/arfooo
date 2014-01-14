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


class UserModel extends Model
{
    protected $primaryKey = "userId";

    function getUsersWithRole($role)
    {
        $c = new Criteria();
        $c->add("role", $role);
        return $this->findAll($c, "*", true);
    }

    function changeUserEmail($userId, $email)
    {
        $data = array("email" => $email);
        $this->updateByPk($data, $userId);

        $c = new Criteria();
        $c->add("webmasterId", $userId);
        $data = array("webmasterEmail" => $email);
        $this->site->update($data, $c);
    }

    function del(Criteria $c)
    {
        parent::del($c);
        Cacher::getInstance()->clean("tag", array("user"));
    }

    function insert($data)
    {
        parent::insert($data);
        Cacher::getInstance()->clean("tag", array("user"));
    }

    function update($data, Criteria $c)
    {
        parent::update($data, $c);
        Cacher::getInstance()->clean("tag", array("user"));
    }
}

class UserRecord extends ModelRecord
{
    function generateNewPassword()
    {
        $newPassword = substr(md5(rand()), 0, 10);
        $this->password = md5($newPassword);
        $this->save();
        return $newPassword;
    }
}
