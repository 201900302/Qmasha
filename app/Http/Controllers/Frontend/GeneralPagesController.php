<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralPagesController extends Controller
{
    //

    public function ShowAboutPage()
    {
        return view('frontend.general_pages.about');
    }

    public function ShowDeliveryTermsPage()
    {
        return view('frontend.general_pages.delivery_terms');
    }

    public function ShowFaqsPage()
    {
        return view('frontend.general_pages.faqs');
    }

    public function ShowJoiningCriteriaPage()
    {
        return view('frontend.general_pages.joining_criteria');
    }

    public function ShowPaymentMethodsPage()
    {
        return view('frontend.general_pages.payment_methods');
    }

    public function ShowPrivacyPolicyPage()
    {
        return view('frontend.general_pages.privacy_policy');
    }

    public function ShowTermsConditionsPage()
    {
        return view('frontend.general_pages.terms_conditions');
    }
}
