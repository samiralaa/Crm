<?php

namespace App\Http\Controllers\CRM\Emails;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailTemplatesService;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{

    protected $email_template_service;
    public function __construct(EmailTemplatesService $email_template_service)
    {
        $this->email_template_service = $email_template_service;
    }
    public function processListOfEmailTemplates()
    {
        $email_templates = $this->email_template_service->getAllEmailsTemplates();
      
        return view('crm.emails.email_templates',compact('email_templates'));
    }

    public function processRenderCreateForm()
    {
        return view('crm.emails.create_email_template');
    }

    public function processStoreEmailTemplate(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content_type' => 'required|string|in:HTML,Text',
            'content' => 'required',
        ]);

        EmailTemplate::create($request->all());
        return redirect()->route('email-templates.index')->with('success', 'Template created successfully');
    }

    public function processDeleteEmailTemplate ($id)
    {
        $emailtemplate = EmailTemplate::find($id);
        $emailtemplate->delete();
        return redirect()->route('email-templates.index')->with('success', 'Template deleted successfully');
    }
}
