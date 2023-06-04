@extends('frontend.master_dashboard')
@section('main')

<div class="bg-light py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Frequently Asked Questions</strong></div>
      </div>
    </div>
  </div>  

  <div class="site-section border-bottom" data-aos="fade">
    <div class="container">
      <div class="row mb-5 p-2">
 
          <div class="site-section-heading pt-3 mb-4">
          <h2 class="text-black">Frequently Asked Questions</h2>
          </div>
      </div>
         <div class="row mb-5">
      <div class="col-lg-4">
          <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
              <a href="#tab1" class="nav-link active" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
                  <span class="icon-account_circle"></span> Website and Accounts
              </a>
              <a href="#tab2" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab2" aria-selected="false">
                  <span class="icon-shopping-bag"></span> Orders
              </a>
              <a href="#tab3" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab3" aria-selected="false">
                  <span class="icon-payment"></span> Payment
              </a>
              <a href="#tab4" class="nav-link" data-toggle="pill" role="tab" aria-controls="tab4" aria-selected="false">
                  <span class="icon-truck"></span> Delivery
                  
              </a>
              
          </div>
      </div>
      <div class="col-lg-8">
          <div class="tab-content" id="faq-tab-content">
              <div class="tab-pane show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                  <div class="accordion" id="accordion-tab-1">
                      <div class="card">
                          <div class="card-header" id="accordion-tab-1-heading-1">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-1" aria-expanded="false" aria-controls="accordion-tab-1-content-1"><span>How secure is shopping at Qmasha?</span></button>
                              </h5>
                          </div>
                          <div class="collapse show" id="accordion-tab-1-content-1" aria-labelledby="accordion-tab-1-heading-1" data-parent="#accordion-tab-1">
                              <div class="card-body">
                                  <p>Shopping on Qmasha’s website is guaranteed to be 100% secure. All stored credit cards and payment details are encrypted with the highest levels of security before being transmitted. We follow stringent protocols to ensure that each of our customer’s data is protected.</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-1-heading-2">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-2" aria-expanded="false" aria-controls="accordion-tab-1-content-2">How do I change my personal information?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-1-content-2" aria-labelledby="accordion-tab-1-heading-2" data-parent="#accordion-tab-1">
                              <div class="card-body">
                                  <p>1. Log in to your account<br>2. Click on My Account at the top of the page<br>3. Click on Edit<br>4. Edit the info you would like to modify<br>5. Press the Save button. </p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-1-heading-3">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-3" aria-expanded="false" aria-controls="accordion-tab-1-content-3">How do I reset my password?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-1-content-3" aria-labelledby="accordion-tab-1-heading-3" data-parent="#accordion-tab-1">
                              <div class="card-body">
                                  <p>1. Log in to your account<br>2.Click on My Account at the top of the page<br>3. Click on Account Information<br>3.Click on the Change Password check box<br>4. Fill in the required fields<br>5. Press the Save button.</p>
                              </div>
                          </div>
                          
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-1-heading-4">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-1-content-4" aria-expanded="false" aria-controls="accordion-tab-1-content-4">HOW do I change my address or add a new one?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-1-content-4" aria-labelledby="accordion-tab-1-heading-4" data-parent="#accordion-tab-1">
                              <div class="card-body">
                                  <p>Log into your Qmasha account and update your details through Profile.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              
              
              
              <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="tab2">
                  <div class="accordion" id="accordion-tab-2">
                      <div class="card">
                          <div class="card-header" id="accordion-tab-2-heading-1">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-1" aria-expanded="false" aria-controls="accordion-tab-2-content-1">How can I pay for my order?</button>
                              </h5>
                          </div>
                          <div class="collapse show" id="accordion-tab-2-content-1" aria-labelledby="accordion-tab-2-heading-1" data-parent="#accordion-tab-2">
                              <div class="card-body">
                                  <p>You can pay for your order using your Credit Card, PayPal, or in cash on delivery</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-2-heading-2">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-2" aria-expanded="false" aria-controls="accordion-tab-2-content-2">Which Currency is accepted?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-2-content-2" aria-labelledby="accordion-tab-2-heading-2" data-parent="#accordion-tab-2">
                              <div class="card-body">
                                  <p>We accept the local currency. For example in Bahrain, we accept BHD</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-2-heading-3">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-3" aria-expanded="false" aria-controls="accordion-tab-2-content-3">Will I get discount when ordering large quantities?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-2-content-3" aria-labelledby="accordion-tab-2-heading-3" data-parent="#accordion-tab-2">
                              <div class="card-body">
                                  <p>There will be no additional discounts for larger quantities. However, always keep an eye out for different offers, bundles, and sales that are often available on our website</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-2-heading-4">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-4" aria-expanded="false" aria-controls="accordion-tab-2-content-4">Can I see the items somewhere? Do you have showrooms?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-2-content-4" aria-labelledby="accordion-tab-2-heading-4" data-parent="#accordion-tab-2">
                              <div class="card-body">
                                  <p>Since having a showroom defeats the purpose of a convenient online shopping experience, we do make sure each product is showcased with an adequate number of images along with an extensive and thorough item description that you can always rely on. Furthermore, our Customer Service team is always ready to assist you to the best of their ability in case you had any additional questions.</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-2-heading-5">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-2-content-5" aria-expanded="false" aria-controls="accordion-tab-2-content-5">Can I cancel my order?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-2-content-5" aria-labelledby="accordion-tab-2-heading-5" data-parent="#accordion-tab-2">
                              <div class="card-body">
                                  <p>As long as the order is pending and  not confirmed yet (less than 1 day), you can cancel it. </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              
              
              
              <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="tab3">
                  <div class="accordion" id="accordion-tab-3">
                      <div class="card">
                          <div class="card-header" id="accordion-tab-3-heading-1">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-1" aria-expanded="false" aria-controls="accordion-tab-3-content-1">What payment methods do you accept?</button>
                              </h5>
                          </div>
                          <div class="collapse show" id="accordion-tab-3-content-1" aria-labelledby="accordion-tab-3-heading-1" data-parent="#accordion-tab-3">
                              <div class="card-body">
                                  <p><strong>Cash on Delivery</strong><br>For customers without access to a credit card, we accept Cash on Delivery (COD) as an alternative payment method for orders. Please note that since the COD service is costly for us to provide, cash payment orders will be charged additionally per order no matter the number of items your order contains. </p>
                                  <p><strong>Stripe Payment Gateway</strong><br>At Qmasha, our preferred payment method is via a secure credit card transaction. Rest assured, your card number will be protected using industry-leading encryption standards. We guarantee a safe shopping experience on our website. Orders completed with credit cards will not be charged any additional fees.</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-3-heading-2">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-2" aria-expanded="false" aria-controls="accordion-tab-3-content-2">Are my bank details trusted for online payments at Qmasha?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-3-content-2" aria-labelledby="accordion-tab-3-heading-2" data-parent="#accordion-tab-3">
                              <div class="card-body">
                                  <p>We actually use industry-leading encryption standards! This encrypts the data you provide to us, ensures it is safe and not accessible to any third party. From your side, the most important is to protect your password. Your data is only used to process orders and to serve you better. It will be under no circumstances disclosed to any third party. </p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-3-heading-3">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-3" aria-expanded="false" aria-controls="accordion-tab-3-content-3">Why it is better to use prepaid methods of payment?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-3-content-3" aria-labelledby="accordion-tab-3-heading-3" data-parent="#accordion-tab-3">
                              <div class="card-body">
                                  <p>If you use a prepaid method of payment (Credit card or PayPal), you will not have to pay any Cash on Delivery charges.</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-3-heading-4">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-3-content-4" aria-expanded="false" aria-controls="accordion-tab-3-content-4">My credit card details have been rejected, what do I do?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-3-content-4" aria-labelledby="accordion-tab-3-heading-4" data-parent="#accordion-tab-3">
                              <div class="card-body">
                                  <p>Double check the following common mistakes: <br><br><strong>Is the card you used for ATM use only? </strong><br>Some cards are not enabled for e-commerce shopping, contact your bank to enable your card for online shopping.<br><br><strong>Were the required fields entered correctly? </strong><br>Card number, Name on card, CVV code (three digit number on back of card), Expiry date.<br><br><strong>Is there sufficient limit on your credit card?</strong><br>If the above conditions are met, call your bank to check if your credit card is eligible for online purchases or if there is any other reason blocking it. <br>Contact your bank if you are facing any problems with 3D secure. Were the following fields entered correctly? Card number Name on card CVV code (three digit number on back of card) Expiry date. <br><br></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              
              
              
              <div class="tab-pane" id="tab4" role="tabpanel" aria-labelledby="tab4">
                  <div class="accordion" id="accordion-tab-4">
                      <div class="card">
                          <div class="card-header" id="accordion-tab-4-heading-1">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-1" aria-expanded="false" aria-controls="accordion-tab-4-content-1">How long does it take to for my order to get delivered?</button>
                              </h5>
                          </div>
                          <div class="collapse show" id="accordion-tab-4-content-1" aria-labelledby="accordion-tab-4-heading-1" data-parent="#accordion-tab-4">
                              <div class="card-body">
                                  <p>The order processing time differs depending on the items you ordered/ the designer you ordered from. As each designer and each item production process takes different time. Be patient!  <br><br>Once the order item is handed to Qmasha by the boutique/designer, the order takes: <br>- Bahrain: 3 – 4 days<br>- GCC countries: 5 – 10 days <br><br>Delivery change differs depending on the delivery location and the number of boutiques you ordered from. The delivery charge will be displayed on the order checkout page. <br><br>All international shipments (GCC) may be subject to import taxes, customs duties and fees as regulated by the Customs Office of your shipping destination. Fees may vary widely based on the country or city of import. <br><br>Qmasha.com and boutiques are not responsible for delays in delivery due to failure in providing the right delivery address.</p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-4-heading-2">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-2" aria-expanded="false" aria-controls="accordion-tab-4-content-2">How can I track my delivery status?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-4-content-2" aria-labelledby="accordion-tab-4-heading-2" data-parent="#accordion-tab-4">
                              <div class="card-body">
                                  <p>You can check your order status and/or track the delivery of your order through My Orders tab, from your Account Menu inside Qmasha website. </p>
                              </div>
                          </div>
                      </div>
                      <div class="card">
                          <div class="card-header" id="accordion-tab-4-heading-3">
                              <h5>
                                  <button class="btn btn-link questionBtn" type="button" data-toggle="collapse" data-target="#accordion-tab-4-content-3" aria-expanded="false" aria-controls="accordion-tab-4-content-3">Can I unpack and try the items on before I pay for the order?</button>
                              </h5>
                          </div>
                          <div class="collapse" id="accordion-tab-4-content-3" aria-labelledby="accordion-tab-4-heading-3" data-parent="#accordion-tab-4">
                              <div class="card-body">
                                  <p>No, you can’t try the products before paying. After paying, If the product did not satisfy you, you can return it. </p>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>


          </div>
      </div>
  </div>
</div>
      </div>

      
@endsection