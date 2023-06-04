<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use Illuminate\Support\Facades\Validator;


class BotmanController extends Controller
{

    //
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('{message}', function($botman, $message) {
   
            // $this->say('Nice to meet you '.$message);
            $botman->reply("Nice to meet you $message 💛");
            $botman->reply("How Can I help You?");
            $this->askService($botman);

            // if ($message == 'hi') {
            //     $this->askName($botman);
            // }else{
            //     $botman->reply("write 'hi' for testing...");
            //     $this->askName($botman);
            // }
   
        });
   
        $botman->listen();
    }

    // public function askName($botman)
    // {
    //     $botman->ask('Hello! What is your Name?', function(Answer $answer) {
   
    //         $name = $answer->getText();
    //         $this->say('Nice to meet you '.$name);

    //         //store name
    //         $this->userStorage()->save([
    //             'name' => $name,
    //         ]);
    //     });
    // }

    public function askService($botman)
    {
        $q_1 = Question::create('Select Your inquiry category')
        ->callbackId('select_service')
        ->addButtons([
            Button::create('Orders')->value('Orders'),
            Button::create('Payment')->value('Payment'),
            Button::create('Delivery')->value('Delivery'),
            Button::create('Qmasha Website and Accounts')->value('Website'),
            Button::create('Other')->value('Other'),
        ]);

        $botman->ask($q_1, function(Answer $answer) {

            if ($answer->isInteractiveMessageReply()) {

                $service = $answer->getValue();
                if($service != 'Other'){
                $this->say('Alright, Here is the '.$service.' Related Quastions..');
                }
                if($service == 'Orders'){
                    $this->say('Alright, Here is the '.$service.' Related Quastions..');
                    //$this->askOrdersQuestion($botman);
                    $q_2 = Question::create('What do you what to ask about?')
        ->callbackId('select_question_orders')
        ->addButtons([
            Button::create('How can I pay for my order?')->value(1),
            Button::create('Will I get discount when ordering large quantities?')->value(2),
            Button::create('Can I see or try the items somewhere? Do you have showrooms?')->value(3),
            Button::create('Can I cancel my order?')->value(4),
            Button::create('Where can I find my order status?')->value(5),
        ]);

        $this->ask($q_2, function(Answer $answer) {

            if ($answer->isInteractiveMessageReply()) {

                $service = $answer->getValue();
                

                if($service == 1){
                    $this->say('You can pay for your order using your Credit Card or Visa using Srtipe gateway, or in cash on delivery');
                    // $this->askOrdersQuestion($botman);
                }
                elseif($service == 2){
                    $this->say('There will be no additional discounts for larger quantities. However, always keep an eye out for different offers, bundles, and sales that are often available on our website');
                    // $this->askPaymentQuestion($botman);
                    
                }
                elseif($service == 3){
                    $this->say('Since having a showroom defeats the purpose of a convenient online shopping experience, we do make sure each product is showcased with an adequate number of images along with an extensive and thorough item description that you can always rely on. Furthermore, our Customer Service team is always ready to assist you to the best of their ability in case you had any additional questions.');
                    // $this->askDeliveryQuestion($botman);
                    
                }
                elseif($service == 4){
                    $this->say('As long as the order is pending and not confirmed yet (less than 12 hours), you can cancel it.');
                    // $this->askQmashaQuestion($botman);
                }
                elseif($service == 5){
                    $this->say('Go to the Dashboard -> My Orders -> Take your order invoice id -> Go to Track order -> insert your order invoice id');
                    // $this->askOtherQuestion($botman);
                }

                //$this->askFeedback($botman);
                $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

                    $answer_yn = $answer->getText();
                    if ($answer_yn == 'yes') {
        
                        $this->say('Thank you 😊 Have a nice day!');
                    }
                    elseif ($answer_yn == 'no') {
                        $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
                    }
        
                    else{
        
                    }
                });

            }
            else{
                $this->say('I did not understand.. ');
                // askService();
            }
            
        });




                    
                }
                elseif($service == 'Payment'){
                    //$this->askPaymentQuestion($botman);
                    $q_3 = Question::create('What do you what to ask about?')
                    ->callbackId('select_question_payment')
                    ->addButtons([
                        Button::create('What payment method do you accept?')->value(1),
                        Button::create('Is Qmasha online payment trusted to use my bank details?')->value(2),
                        Button::create('Why it is better to use prepaid method for payment?')->value(3),
                        Button::create('My credit card details have been rejected, What do I do?')->value(4),
                    ]);

                    $this->ask($q_3, function(Answer $answer) {
            
                        if ($answer->isInteractiveMessageReply()) {
            
                            $service = $answer->getValue();
                            
            
                            if($service == 1){
                                $this->say('Cash on Delivery, Credit Cards, Visa');
                               
                            }
                            elseif($service == 2){
                                $this->say('We actually use industry-leading encryption standards! This encrypts the data you provide to us, ensures it is safe and not accessible to any third party. From your side, the most important is to protect your password. Your data is only used to process orders and to serve you better. It will be under no circumstances disclosed to any third party.');
                               
                                
                            }
                            elseif($service == 3){
                                $this->say('If you use a prepaid method of payment (Credit card or PayPal), you will not have to pay any Cash on Delivery charges.');
                               
                                
                            }
                            elseif($service == 4){
                                $this->say('Double check the following common mistakes:
                                <br><br>
                                Is the card you used for ATM use only?<br>
                                Some cards are not enabled for e-commerce shopping, contact your bank to enable your card for online shopping.
                                <br><br>
                                Were the required fields entered correctly?<br>
                                Card number, Name on card, CVV code (three digit number on back of card), Expiry date.
                                <br><br>
                                Is there sufficient limit on your credit card?<br>
                                If the above conditions are met, call your bank to check if your credit card is eligible for online purchases or if there is any other reason blocking it.
                                Contact your bank if you are facing any problems with 3D secure. Were the following fields entered correctly? Card number Name on card CVV code (three digit number on back of card) Expiry date.');
                                
                            }
            
                            //$this->askFeedback($botman);
                            $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {
            
                                $answer_yn = $answer->getText();
                                if ($answer_yn == 'yes') {
                    
                                    $this->say('Thank you 😊 Have a nice day!');
                                }
                                elseif ($answer_yn == 'no') {
                                    $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
                                }
                    
                                else{
                    
                                }
                            });
                            
            
                        }
                        else{
                            $this->say('I did not understand.. ');
                            // askService();
                        }
                        
                    });



                    
                }
                elseif($service == 'Delivery'){
                   // $this->askDeliveryQuestion($botman);
                   $q_4 = Question::create('What do you what to ask about?')
                   ->callbackId('select_question_delivery')
                   ->addButtons([
                       Button::create('How long does it take to my order to be delivered?')->value(1),
                       Button::create('Can I unpick and try the item before I pay for the order?')->value(2),
                       ]);
           
                   $this->ask($q_4, function(Answer $answer) {
           
                       if ($answer->isInteractiveMessageReply()) {
           
                           $service = $answer->getValue();
                           
           
                           if($service == 1){
                               $this->say('The order processing time differs depending on the items you ordered/ the designer you ordered from. As each designer and each item production process takes different time. Be patient!
                                   <br><br>
                               Once the order item is handed to Qmasha by the boutique/designer, the order takes: <br>
                               - Bahrain: 3 – 4 days <br>
                               - GCC countries: 5 – 10 days');
                               // $this->askOrdersQuestion($botman);
                           }
                           elseif($service == 2){
                               $this->say('No, you can’t try the products before paying. After paying, If the product did not satisfy you, you can return it.');
                               // $this->askPaymentQuestion($botman);
                               
                           }
           
                           //$this->askFeedback($botman);
                           $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {
           
                               $answer_yn = $answer->getText();
                               if ($answer_yn == 'yes') {
                   
                                   $this->say('Thank you 😊 Have a nice day!');
                               }
                               elseif ($answer_yn == 'no') {
                                   $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
                               }
                   
                               else{
                   
                               }
                           });
           
                       }
                       else{
                           $this->repeat('I did not understand.. ');
                           // askService();
                       }
                       
                   });





                    
                }
                elseif($service == 'Website'){
                    //$this->askQmashaQuestion($botman);
                    $q_5 = Question::create('What do you what to ask about?')
        ->callbackId('select_question_orders')
        ->addButtons([
            Button::create('How secure is shopping at qmasha?')->value(1),
            Button::create('How do I change my personal information?')->value(2),
            Button::create('How do I change my password?')->value(3),
            ]);

        $this->ask($q_5, function(Answer $answer) {

            if ($answer->isInteractiveMessageReply()) {

                $service = $answer->getValue();
                

                if($service == 1){
                    $this->say('Shopping on Qmasha’s website is guaranteed to be 100% secure. All stored credit cards and payment details are encrypted with the highest levels of security before being transmitted. We follow stringent protocols to ensure that each of our customer’s data is protected.');
                    // $this->askOrdersQuestion($botman);
                }
                elseif($service == 2){
                    $this->say('Log in to your account -> Go to Dashboard -> Click on My information -> Edit the info you would like to modify -> Press the Save button.');
                    // $this->askPaymentQuestion($botman);
                    
                }
                elseif($service == 3){
                    $this->say('SLog in to your account -> Go to Dashboard -> Click on Change password -> Enter your current password and the new password -> Press the Save button.');
                    // $this->askDeliveryQuestion($botman);
                }
                //$this->askFeedback($botman);
                $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

                    $answer_yn = $answer->getText();
                    if ($answer_yn == 'yes') {
        
                        $this->say('Thank you 😊 Have a nice day!');
                    }
                    elseif ($answer_yn == 'no') {
                        $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
                    }
        
                    else{
        
                    }
                });
                

            }
            else{
                $this->repeat('I did not understand.. ');
                // askService();
            }
            
        });


                }
                elseif($service == 'Other'){
                    //$this->askCustomQuestion($botman);
                    $this->ask('What is your question ?', function(Answer $answer) {

                        $custom_qustion = $answer->getText();
                        // $this->reply('Nice to meet you ');
                        $this->say('I cannot recognize your question! Please Check the FAQs page, you can find it in the footer, if this was not helpful contact Qmasha team: Qmahsa.ecommerceCompany@gmail.com');
                        //$this->askFeedback($botman);
                        
            
                        $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {
            
                            $answer_yn = $answer->getText();
                            if ($answer_yn == 'yes') {
                
                                $this->say('Thank you 😊 Have a nice day!');
                            }
                            elseif ($answer_yn == 'no') {
                                $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
                            }
                
                            else{
                
                            }
                        });
                    
            
                    });
                    $this->say('hahaha ');
                }

            }
            else{
                $this->say('I did not understand.. ');
                // askService();
            }
            
        });
    }



    // public function askOrdersQuestion($botman)
    // {
    //     $q = Question::create('What do you what to ask about?')
    //     ->callbackId('select_question_orders')
    //     ->addButtons([
    //         Button::create('How can I pay for my order?')->value(1),
    //         Button::create('Will I get discount when ordering large quantities?')->value('2'),
    //         Button::create('Can I see or try the items somewhere? Do you have showrooms?')->value('3'),
    //         Button::create('Can I cancel my order?')->value('4'),
    //         Button::create('Where can I find my order status?')->value('5'),
    //     ]);

    //     $this->ask($q, function(Answer $answer) {

    //         if ($answer->isInteractiveMessageReply()) {

    //             $service = $answer->getValue();
                

    //             if($service == 1){
    //                 $this->say('You can pay for your order using your Credit Card or Visa using Srtipe gateway, or in cash on delivery');
    //                 // $this->askOrdersQuestion($botman);
    //             }
    //             elseif($service == 2){
    //                 $this->say('There will be no additional discounts for larger quantities. However, always keep an eye out for different offers, bundles, and sales that are often available on our website');
    //                 // $this->askPaymentQuestion($botman);
                    
    //             }
    //             elseif($service == 3){
    //                 $this->say('Since having a showroom defeats the purpose of a convenient online shopping experience, we do make sure each product is showcased with an adequate number of images along with an extensive and thorough item description that you can always rely on. Furthermore, our Customer Service team is always ready to assist you to the best of their ability in case you had any additional questions.');
    //                 // $this->askDeliveryQuestion($botman);
                    
    //             }
    //             elseif($service == 4){
    //                 $this->say('As long as the order is pending and not confirmed yet (less than 12 hours), you can cancel it.');
    //                 // $this->askQmashaQuestion($botman);
    //             }
    //             elseif($service == 5){
    //                 $this->say('Go to the Dashboard -> My Orders -> Take your order invoice id -> Go to Track order -> insert your order invoice id');
    //                 // $this->askOtherQuestion($botman);
    //             }

    //             //$this->askFeedback($botman);
    //             $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //                 $answer_yn = $answer->getText();
    //                 if ($answer_yn == 'yes') {
        
    //                     $this->say('Thank you 😊 Have a nice day!');
    //                 }
    //                 elseif ($answer_yn == 'no') {
    //                     $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //                 }
        
    //                 else{
        
    //                 }
    //             });

    //         }
    //         else{
    //             $this->say('I did not understand.. ');
    //             // askService();
    //         }
            
    //     });
    // }

    // public function askPaymentQuestion($botman)
    // {
    //     $q = Question::create('What do you what to ask about?')
    //     ->callbackId('select_question_payment')
    //     ->addButtons([
    //         Button::create('What payment method do you accept?')->value(1),
    //         Button::create('Is Qmasha online payment trusted to use my bank details?')->value(2),
    //         Button::create('Why it is better to use prepaid method for payment?')->value(3),
    //         Button::create('My credit card details have been rejected, What do I do?')->value(4),
    //     ]);

    //     $botman->ask($q, function(Answer $answer) {

    //         if ($answer->isInteractiveMessageReply()) {

    //             $service = $answer->getValue();
                

    //             if($service == 1){
    //                 $this->say('Cash on Delivery, Credit Cards, Visa');
                   
    //             }
    //             elseif($service == 2){
    //                 $this->say('We actually use industry-leading encryption standards! This encrypts the data you provide to us, ensures it is safe and not accessible to any third party. From your side, the most important is to protect your password. Your data is only used to process orders and to serve you better. It will be under no circumstances disclosed to any third party.');
                   
                    
    //             }
    //             elseif($service == 3){
    //                 $this->say('If you use a prepaid method of payment (Credit card or PayPal), you will not have to pay any Cash on Delivery charges.');
                   
                    
    //             }
    //             elseif($service == 4){
    //                 $this->say('Double check the following common mistakes:
    //                 <br><br>
    //                 Is the card you used for ATM use only?<br>
    //                 Some cards are not enabled for e-commerce shopping, contact your bank to enable your card for online shopping.
    //                 <br><br>
    //                 Were the required fields entered correctly?<br>
    //                 Card number, Name on card, CVV code (three digit number on back of card), Expiry date.
    //                 <br><br>
    //                 Is there sufficient limit on your credit card?<br>
    //                 If the above conditions are met, call your bank to check if your credit card is eligible for online purchases or if there is any other reason blocking it.
    //                 Contact your bank if you are facing any problems with 3D secure. Were the following fields entered correctly? Card number Name on card CVV code (three digit number on back of card) Expiry date.');
                    
    //             }

    //             //$this->askFeedback($botman);
    //             $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //                 $answer_yn = $answer->getText();
    //                 if ($answer_yn == 'yes') {
        
    //                     $this->say('Thank you 😊 Have a nice day!');
    //                 }
    //                 elseif ($answer_yn == 'no') {
    //                     $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //                 }
        
    //                 else{
        
    //                 }
    //             });
                

    //         }
    //         else{
    //             $this->say('I did not understand.. ');
    //             // askService();
    //         }
            
    //     });
    // }


    // public function askDeliveryQuestion($botman)
    // {
    //     $q = Question::create('What do you what to ask about?')
    //     ->callbackId('select_question_delivery')
    //     ->addButtons([
    //         Button::create('How long does it take to my order to be delivered?')->value(1),
    //         Button::create('Can I unpick and try the item before I pay for the order?')->value(2),
    //         ]);

    //     $this->ask($q, function(Answer $answer) {

    //         if ($answer->isInteractiveMessageReply()) {

    //             $service = $answer->getValue();
                

    //             if($service == 1){
    //                 $this->say('The order processing time differs depending on the items you ordered/ the designer you ordered from. As each designer and each item production process takes different time. Be patient!
    //                     <br><br>
    //                 Once the order item is handed to Qmasha by the boutique/designer, the order takes: <br>
    //                 - Bahrain: 3 – 4 days <br>
    //                 - GCC countries: 5 – 10 days');
    //                 // $this->askOrdersQuestion($botman);
    //             }
    //             elseif($service == 2){
    //                 $this->say('No, you can’t try the products before paying. After paying, If the product did not satisfy you, you can return it.');
    //                 // $this->askPaymentQuestion($botman);
                    
    //             }

    //             //$this->askFeedback($botman);
    //             $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //                 $answer_yn = $answer->getText();
    //                 if ($answer_yn == 'yes') {
        
    //                     $this->say('Thank you 😊 Have a nice day!');
    //                 }
    //                 elseif ($answer_yn == 'no') {
    //                     $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //                 }
        
    //                 else{
        
    //                 }
    //             });

    //         }
    //         else{
    //             $this->repeat('I did not understand.. ');
    //             // askService();
    //         }
            
    //     });
    // }


    // public function askQmashaQuestion($botman)
    // {
    //     $q = Question::create('What do you what to ask about?')
    //     ->callbackId('select_question_orders')
    //     ->addButtons([
    //         Button::create('How secure is shopping at qmasha?')->value(1),
    //         Button::create('How do I change my personal information?')->value(2),
    //         Button::create('How do I change my password?')->value(3),
    //         ]);

    //     $this->ask($q, function(Answer $answer) {

    //         if ($answer->isInteractiveMessageReply()) {

    //             $service = $answer->getValue();
                

    //             if($service == 1){
    //                 $this->say('Shopping on Qmasha’s website is guaranteed to be 100% secure. All stored credit cards and payment details are encrypted with the highest levels of security before being transmitted. We follow stringent protocols to ensure that each of our customer’s data is protected.');
    //                 // $this->askOrdersQuestion($botman);
    //             }
    //             elseif($service == 2){
    //                 $this->say('Log in to your account -> Go to Dashboard -> Click on My information -> Edit the info you would like to modify -> Press the Save button.');
    //                 // $this->askPaymentQuestion($botman);
                    
    //             }
    //             elseif($service == 3){
    //                 $this->say('SLog in to your account -> Go to Dashboard -> Click on Change password -> Enter your current password and the new password -> Press the Save button.');
    //                 // $this->askDeliveryQuestion($botman);
    //             }
    //             //$this->askFeedback($botman);
    //             $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //                 $answer_yn = $answer->getText();
    //                 if ($answer_yn == 'yes') {
        
    //                     $this->say('Thank you 😊 Have a nice day!');
    //                 }
    //                 elseif ($answer_yn == 'no') {
    //                     $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //                 }
        
    //                 else{
        
    //                 }
    //             });
                

    //         }
    //         else{
    //             $this->repeat('I did not understand.. ');
    //             // askService();
    //         }
            
    //     });
    // }



    // public function askCustomQuestion($botman)
    // {

    //     $botman->ask('What is your question ?', function(Answer $answer) {

    //         $custom_qustion = $answer->getText();
    //         // $this->reply('Nice to meet you ');
    //         $this->say('I could Not find as answer! Please Check the FAQs page, you can find it in the footer, if this was not helpful contact Qmasha team: Qmahsa.ecommerceCompany@gmail.com');
    //         //$this->askFeedback($botman);
            

    //         $this->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //             $answer_yn = $answer->getText();
    //             if ($answer_yn == 'yes') {
    
    //                 $this->say('Thank you 😊 Have a nice day!');
    //             }
    //             elseif ($answer_yn == 'no') {
    //                 $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //             }
    
    //             else{
    
    //             }
    //         });
        

    //     });
    // }










    // public function askFeedback($botman)
    // {
    //     $botman->ask('Was that helpful? [yes/no]', function(Answer $answer) {

    //         $answer_yn = $answer->getText();
    //         if ($answer_yn == 'yes') {

    //             $this->say('Thank you 😊 Have a nice day!');
    //         }
    //         elseif ($answer_yn == 'no') {
    //             $this->say('Sorry for that! Qmasha team is working on improving the chatbot in more interactive way 😊');
    //         }

    //         else{

    //         }
    //     });
    // }
    

}
