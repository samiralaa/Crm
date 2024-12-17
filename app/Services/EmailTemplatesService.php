<?php

namespace App\Services;

use App\Models\EmailTemplates;
use App\Queries\EmailsTemplateQueries;

class EmailTemplatesService
{
    

    public function getAllEmailsTemplates()
    {
        return EmailsTemplateQueries::getAllEmailsTemplates();
    }
    
}