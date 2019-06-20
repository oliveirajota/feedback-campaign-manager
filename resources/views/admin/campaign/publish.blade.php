@extends('layouts.admin')

@section('content')

@if(Session::get('msg'))
    <div class="alert alert-{{Session::get('msg.type')}}">
        <span><strong>{{Session::get('msg.txt')}}</strong></span>
    </div>
@endif

{{-- Top Resume--}}
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="wizard" class="form_wizard wizard_horizontal">
            <ul class="wizard_steps anchor">
                <li>
                    <a href="#step-1" class="selected" isdone="1" rel="1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                  Create Campaign<br>
                </span>
                    </a>
                </li>
                <li>
                    <a href="#step-2" class="selected" isdone="0" rel="2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                  Add Content<br>
                </span>
                    </a>
                </li>
                <li>
                    <a href="#step-3" class="selected" isdone="0" rel="3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                  Review Campaign<br>
              </span>
                    </a>
                </li>
                <li>
                    <a href="#step-4" class="disabled" isdone="0" rel="4">
                        <span class="step_no">4</span>
                        <span class="step_descr">
                  Publish Campaign<br>
                  <small>&nbsp;</small>
                </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Feedback Campaign Details<small>Please review your Feedback Campaign</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12 invoice-header">
                            <h1>
                                <i class="fa fa-recycle"></i> {{ $campaign['name'] }}
                                <small class="pull-right">Starts At: {{ $campaign['start_at_f'] }}</small>
                            </h1>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table">
                            <h3>General Questions</h3>
                            <table class="table table-striped">
                                <tbody>

                                @foreach ($campaignQuestions as $question)
                                    <tr>
                                        <td>{{ $question['question'] }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <h3>Questions about Collaborators</h3>
                            <table class="table table-striped">
                                <tbody>

                                @foreach ($collaboratorQuestions as $question)
                                    <tr>
                                        <td>{{ $question['question'] }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <h3>Collaborators</h3>
                            <table class="table table-striped">
                                <tbody>

                                @foreach ($collaborators as $collaborator)
                                    <tr>
                                        <td>{{ $collaborator['collaborator']['name'] }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Publish Campaign:</p>
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                After publishing your campaign, you will be able to trigger an email for each Collaborator asking him to participate.
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Ends at: {{ $campaign['expire_at_f'] }}</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th style="width:50%">Total Questions:</th>
                                        <td>{{ $summary['questions'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>General Questions</th>
                                        <td>{{ $summary['campaign_questions'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Collaborator Questions</th>
                                        <td>{{ $summary['collaborator_questions'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Collaborators</th>
                                        <td>{{ $summary['collaborators'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="if (!window.__cfRLUnblockHandlers) return false; window.print();">
                                <i class="fa fa-print"></i> Print
                            </button>
                            <button class="btn btn-success pull-right" data-toggle="modal" data-target="#publish-modal">
                                <i class="fa fa-arrow-up"></i> Publish
                            </button>
                            <button class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="publish-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Publish Feedback Campaing</h4>
            </div>
            <div class="modal-body">
                <h4>Do you want to publish this Feedback Campaing?</h4>
                <p>After publishing the Feedback Campaign will not be possible to change the Questions or add new Collaborators.</p>
                <p>Yet you will be able to cancel the Campaign and create a new one.</p>
            </div>
            <div class="modal-footer">
                <form data-parsley-validate class="form-horizontal form-label-left" action="/campaigns/{{ $campaign['id'] }}/publish" method="post">

                    {{ Form::token() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>

        </div>
    </div>
</div>

@stop

@section('js')

@stop