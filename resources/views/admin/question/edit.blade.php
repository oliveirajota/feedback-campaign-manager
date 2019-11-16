@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Base Questions</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Create new Question</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form data-parsley-validate class="form-horizontal form-label-left" action="{{ route('questions.update', $question['id']) }}" method="post">

                        {{ Form::token() }}
                        <input type="hidden" name="_method" value="PUT" />

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Please correct the following errors
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Question<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('question', $question['question'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('question'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('question') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::text('description', $question['description'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                                @if ($errors->has('description'))
                                    <span id="helpBlock2" class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Question Type<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                {{ Form::select('type', $questionType, $question['type'], ['class' => 'form-control col-md-7 col-xs-12']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Update Question</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop