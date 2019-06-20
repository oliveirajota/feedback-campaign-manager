@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Company</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create new Company</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" action="{{ route('companies.store') }}" method="post">

                        {{ Form::token() }}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Please correct the following errors
                            </div>
                        @endif

                        @if(Session::all('msg'))
                            <div class="alert alert-{{Session::get('msg.type')}}">
                                {{Session::get('msg.txt')}}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Please correct the following errors
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('name', null, ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('name'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop