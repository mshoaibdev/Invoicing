<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiry;
use Illuminate\Http\Request;
use App\Http\Requests\ContactForm;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    //

    public function index()
    {
        return view('pages.index');
    }

    public function about()
    {
        return view('pages.about');
    }


    public function contact()
    {
        return view('pages.contact');
    }

    public function appDevelopment()
    {
        return view('pages.app-development');
    }

    public function blockchainGameDevelopment()
    {
        return view('pages.blockchain-game-development');
    }

    public function businessProcessOutsourcing()
    {
        return view('pages.business-process-outsourcing');
    }

    public function cloudTeam()
    {
        return view('pages.cloud-team');
    }

    public function digitalCommerce()
    {
        return view('pages.digital-commerce');
    }

    public function eCommerceDevelopment()
    {
        return view('pages.e-commerce-development');
    }

    public function gameAppDevelopment()
    {
        return view('pages.game-app-development');
    }

    public function qualityAssurance()
    {
        return view('pages.quality-assurance');
    }

    public function security()
    {
        return view('pages.security');
    }

    public function userExperience()
    {
        return view('pages.user-experience');
    }

    // designAndDevelopment

    public function packages()
    {
        return view('pages.packages');
    }

    // contactForm

    public function contactForm(ContactForm $request)
    {


        $formData = $request->validated();

        Mail::to('ray@themetamavericks.com')->send(new ContactInquiry($formData));


        return response()->json([
            'message' => 'your request has been submitted successfully',
            'data' => $formData
        ], 200);
    }

}
