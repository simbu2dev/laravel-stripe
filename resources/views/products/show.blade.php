<x-layout>
    <x-slot:title>
        Product Info - {{ $product->name }}
        </x-slot>

        <div class="container mt-5">
            <div class="row mt-3 gap-2">
                <div class="col-sm-6 col-md-12 card mb-3">
                    <h3 class="card-header">Product Information</h3>                   
                    <div class="col">    
                        <div class="row mb-2">
                            <div class="col"><strong>Product Name:</strong></div>
                            <div class="col">{{ $product->name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">Product Description:</div>
                            <div class="col">{{ $product->description }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col"><strong>Price:</strong></div>
                            <div class="col">₹{{ $product->price }}</div>
                        </div>   
                    </div>
                </div>
                <div class="col-sm-6 col-md-12 card mb-3">
                    <h3 class="card-header">Credit card payment</h3> 
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <form 
                                    role="form" 
                                    action="{{ route('stripe.post') }}" 
                                    method="POST" 
                                    class="require-validation"
                                    data-cc-on-file="false"
                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                    id="payment-form">
                                @csrf
                            <div class='row'>
                                <div class='form-group required'>
                                    <div class="col-sm-2">
                                        <label class='col-form-label'>Name on Card</label> 
                                    </div>
                                    <div class="col-sm-6">
                                        <input class='form-control' type='text' placeholder="ex.John Doe">
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='form-group required'>
                                    <div class="col-sm-2">
                                        <label class='col-form-label'>Card Number</label> 
                                    </div>
                                    <div class="col-sm-6">
                                        <input autocomplete='off' class='form-control card-number' size='20' type='number' placeholder="ex.465832581167">
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-2 cvc required'>
                                    <label class='col-form-label'>CVC</label>                                     
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' type='number'>
                                </div>
                                <div class='col-sm-2 expiration required'>
                                    <label class='col-form-label'>Expiration Month</label> 
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='number'>
                                </div>
                                <div class='col-sm-2 expiration required'>
                                    <label class='col-form-label'>Expiration Year</label> 
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='number'>
                                </div>
                            </div>
                            <div class='row mt-3 mb-3'>
                                <div class='col-md-6 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ₹ {{$product->price}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">                    
                    <a href="javascript:history.back()" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
</x-layout>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/   
    var $form = $(".require-validation");  
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"), inputSelector = ['input[type=text]', 'input[type=number]'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');   
        $('.has-danger').removeClass('has-danger');
        $('.is-invalid').removeClass('is-invalid');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            valid = false;
            $input.addClass('is-invalid');
            $input.parent().addClass('has-danger');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    });
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];   
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }  
});
</script>