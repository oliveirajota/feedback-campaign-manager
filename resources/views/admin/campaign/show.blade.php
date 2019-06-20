@extends('layouts.admin')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{ $campaign['name'] }}</h3>
        </div>

    </div>

    <div class="clearfix"></div>

    @if(Session::get('msg'))
        <div class="alert alert-{{Session::get('msg.type')}}">
            <span><strong>{{Session::get('msg.txt')}}</strong></span>
        </div>
    @endif

    {{-- Top Resume--}}
    <div class="row">
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-question"></i>
                </div>
                <div class="count">{{ $summary['total_questions'] }}</div>

                <h3>Questions</h3>
                <p>For each Collaborator</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i>
                </div>
                <div class="count">{{ $summary['collaborators'] }}</div>

                <h3>Collaborators</h3>
                <p>Participating on this Campaign</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i>
                </div>
                <div class="count">{{ $summary['total_answers'] }}</div>

                <h3>Answers</h3>
                <p>Total answers at the end of this Campaign</p>
            </div>
        </div>
    </div>

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
                <a href="#step-2" class="disabled" isdone="0" rel="2">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                      Add Content<br>
                    </span>
                </a>
            </li>
            <li>
                <a href="#step-3" class="disabled" isdone="0" rel="3">
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

    <div class="row">

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel fixed_height_320">
                <div class="x_title">
                    <h2>Campaign Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <p>{{ $campaign['description'] }}</p>
                    <p class="title">Start At</p>
                    <p>{{ $campaign['start_at'] }}</p>
                    <p class="title">Ends At</p>
                    <p>{{ $campaign['expire_at'] }}</p>

                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel fixed_height_320">
                <div class="x_title">
                    <h2>Status and Actions</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h4>Status: <span class="label label-default">{{ $campaign['status'] }}</span></h4>

                    @if ($campaign['is_publishable'])
                    <a class="btn btn-success" href="http://dev.feedback.com/campaigns/{{ $campaign['id'] }}/publish">
                        <i class="fa fa-arrow-up"></i> Publish Campaign
                    </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel fixed_height_320">
                <div class="x_title">
                    <h2>Profile Settings <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <ul class="quick-list">
                            <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a></li>
                            <li><i class="fa fa-thumbs-up"></i><a href="#">Favorites</a></li>
                            <li><i class="fa fa-calendar-o"></i><a href="#">Activities</a></li>
                            <li><i class="fa fa-cog"></i><a href="#">Settings</a></li>
                            <li><i class="fa fa-area-chart"></i><a href="#">Logout</a></li>
                        </ul>

                        <div class="sidebar-widget">
                            <h4>Profile Completion</h4>
                            <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px; height: 100px;"></canvas>
                            <div class="goal-wrapper">
                                <span id="gauge-text" class="gauge-value gauge-chart pull-left">2000</span>
                                <span class="gauge-value pull-left">%</span>
                                <span id="goal-text" class="goal-value pull-right">100%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h4>Questions</h4>
                </div>

                <div class="x_content">
                    @if ($questions)

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question['question'] }}</td>
                                    <td>{{ $question['type'] }}</td>
                                    <td class="text-right">
                                        {{--<a href="{{ route('questions.edit', $question['id']) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>--}}
                                        {{--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="jumbotron">
                            <h3>No Questions Yet!</h3>
                            <p>Please add Questions to this Campaign.</p>
                            <a class="btn btn-success" href="/campaigns/{{ $campaign['id'] }}/questions/add">
                                <i class="fa fa-question"></i> Add Questions
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h4>Collaborators</h4>
                </div>

                <div class="x_content">
                    @if ($collaborators)

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($collaborators as $collaborator)
                                <tr>
                                    <td>{{ $collaborator['collaborator']['name'] }}</td>
                                    <td>{{ $collaborator['status'] }}</td>
                                    <td class="text-right">
                                        {{--<a href="{{ route('questions.edit', $question['id']) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>--}}
                                        {{--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h3>No Collaborators Yet!</h3>
                            <p>Please add Collaborators to this Campaign.</p>
                            <a class="btn btn-success" href="/campaigns/{{ $campaign['id'] }}/collaborators/add">
                                <i class="fa fa-question"></i> Add Questions
                            </a>
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>


@stop

@section('js')

@stop