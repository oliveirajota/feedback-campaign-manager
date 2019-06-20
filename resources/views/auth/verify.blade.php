@extends('layouts.visitor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Verify.verify_email_address', 'Test')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Verify.verify_email_fresh_verification_was_sent', 'Test') }}
                        </div>
                    @endif

                    {{ __('Verify.verify_email_before_proceeding') }}
                    {{ __('Verify.verify_email_if_you_didnt_received') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
