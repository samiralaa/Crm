<?php

namespace App\Queries;

use App\Models\EmailTemplate;

class EmailsTemplateQueries
{
     /**
     * Get all deals created in the latest month.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
 

    public static function getAllEmailsTemplates(): \Illuminate\Database\Eloquent\Collection
    {
        return EmailTemplate::all();
    }

    public function getEmailsTemplateById($id)
    {
        return EmailTemplate::find($id);
    }

    public function createEmailsTemplate($data)
    {
        return EmailTemplate::create($data);
    }

    public function updateEmailsTemplate($id, $data)
    {
        $emailsTemplate = EmailTemplate::find($id);
        $emailsTemplate->update($data);
        return $emailsTemplate;
    }

    public function deleteEmailsTemplate($id)
    {
        $emailsTemplate = EmailTemplate::find($id);
        $emailsTemplate->delete();
        return $emailsTemplate;
    }
}
