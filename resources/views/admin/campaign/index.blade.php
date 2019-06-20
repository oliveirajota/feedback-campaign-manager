@extends('layouts.admin')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Feedback Campaigns</h3>
        </div>

    </div>

    <div class="clearfix"></div>

    @if(Session::all('msg'))
        <div class="alert alert-{{Session::get('msg.type')}}">
            <span><strong>{{Session::get('msg.txt')}}</strong></span>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Feedback Campaign List</h2>
                    <a class="btn btn-success pull-right" href="{{ route('campaigns.create') }}">
                        <i class="fa fa-plus"></i> Create Feedback Campaign
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 20%">Campaign</th>
                            <th>Team Members</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th style="width: 20%">#Edit</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($campaigns as $campaign)

                            <tr>
                                <td>
                                    {{ $campaign['name'] }}
                                    <br>
                                    <small>Created {{ $campaign['created_at_f'] }}</small>
                                    <br>
                                    <small>Start At {{ $campaign['start_at_f'] }}</small>
                                    <br>
                                    <small>Ends At {{ $campaign['expire_at_f'] }}</small>
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        @foreach ($campaign['collaborators'] as $collaborator)
                                        <li>
                                            <img src="/images/user.png" class="avatar" alt="Avatar" title="{{ $collaborator['collaborator']['name'] }}">
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="project_progress">
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57" aria-valuenow="56" style="width: 57%;"></div>
                                    </div>
                                    <small>57% Complete</small>
                                </td>
                                <td><span class="label label-default">{{ $campaign['status'] }}</span></td>
                                <td class="text-right">
                                    <a href="{{ route('campaigns.show', $campaign['id']) }}" class="btn btn-warning btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <a href="/campaigns/{{ $campaign['id'] }}/questions/add" class="btn btn-primary btn-xs"><i class="fa fa-question"></i> Add Questions </a>
                                    <a href="/campaigns/{{ $campaign['id'] }}/collaborators/add" class="btn btn-success btn-xs"><i class="fa fa-user"></i> Add Collaborators </a>
                                    <a href="{{ route('campaigns.edit', $campaign['id']) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')

@stop