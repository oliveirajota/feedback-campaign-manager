@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Feedback Campaign</h3>
        </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Edit Feedback Campaign</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" action="{{ route('campaigns.store') }}" method="post">

                        {{ Form::token() }}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('company_id', $companies, $campaign['company_id'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('name', $campaign['name'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('name'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('description', $campaign['description'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('description'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start At<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('start_at', $campaign['start_at'], ['class' => 'form-control col-md-7 col-xs-12 datepicker']) }}
                                @if ($errors->has('start_at'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('start_at') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Expire At<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('expire_at', $campaign['expire_at'], ['class' => 'form-control col-md-7 col-xs-12 datepicker']) }}
                                @if ($errors->has('expire_at'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('expire_at') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Edit Campaign</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker();
        });
    </script>
@stop