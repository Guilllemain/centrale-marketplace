@extends('layouts.app')

@section('css')
    <style>
        .StripeElement {
          background-color: white;
          height: 40px;
          padding: 10px 12px;
          border-radius: 4px;
          border: 1px solid transparent;
          box-shadow: 0 1px 3px 0 #e6ebf1;
          -webkit-transition: box-shadow 150ms ease;
          transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
          box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
          border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
          background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-8">Paiement</h2>
        <div class="mb-12">
            @foreach($payment_types as $payment)
                <input class="mr-2" type="radio" id="{{ $payment['id'] }}" name="payment_type" value="{{ $payment['id'] }}">
                <label class="mr-8" for="{{ $payment['id'] }}">{{ $payment['name'] }}</label>
            @endforeach  
        </div>
        <checkout-component></checkout-component>
    </div>
@endsection

@section('scripts')
@endsection