<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactWithClientController extends Controller
{
    public function index()
    {
        return view('crm.contact-with-client.index');
    }
}
