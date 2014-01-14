<?php
//
// copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
// by Guillaume Hocine (c) 2007 - 2010
// Developer Team : Adrian Galewski
// http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
// Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/
//


class NewsletterEmailModel extends Model
{
    protected $primaryKey = "emailId";

    function validate($request)
    {
        if (!preg_match("#^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$#", $request->email)) {
            return "javascript_config_email_format";
        }

        $c = new Criteria();
        $c->add("email", $request->email);

        $emailExists = ($this->getCount($c));
        
        if (!$emailExists) {
            $c = new Criteria();
            $c->add("webmasterEmail", $request->email);
            $emailExists = $this->site->getCount($c);
        }

        if (!empty($request->addEmail) && $emailExists) {
            return "This email was added earlier";
        }

        if (!empty($request->deleteEmail) && !$emailExists) {
            return "This email do not exists in our db";
        }

        return '';
    }

    function addEmail($email)
    {
        $newsletterEmail = new NewsletterEmailRecord();
        $newsletterEmail->email = $email;
        $newsletterEmail->active = 0;
        $newsletterEmail->save();

        return $newsletterEmail;
    }
}

class NewsletterEmailRecord extends ModelRecord
{

}
