<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MailingListService;

class NewsletterController extends Controller
{
    protected $mailService;

    public function __construct(MailingListService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $response = $this->mailService->subscribe(1, $email);

        return back()->with('flash', 'Vous êtes désormais inscrit à notre newsletter');
    }
}
