@extends('layouts.user')

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

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Feedback Campaign List</h2>
                    <a class="btn btn-success pull-right" href="/user/campaign/{{ $campaign['id'] }}/answer">
                        <i class="fa fa-check"></i> Answer the Questions
                    </a>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if ($questions)

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question['question'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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

                @if ($collaborators)

                    @foreach ($collaborators as $collaborator)
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i>{{ $collaborator['collaborator']['name'] }}</i></h4>
                                    <div class="left col-xs-7">
                                        {{--<h2>{{ $collaborator['collaborator']['name'] }}</h2>--}}
                                        {{--<p><strong>About: </strong> Web Designer / UI. </p>--}}
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-building"></i> Address: </li>
                                            <li><i class="fa fa-phone"></i> Phone #: </li>
                                        </ul>
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                        <img src="/images/user.png" alt="" class="img-circle img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                        <p class="ratings">
                                            <a>4.0</a>
                                            <a href="#"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star"></span></a>
                                            <a href="#"><span class="fa fa-star-o"></span></a>
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <a href="/user/campaign/{{ $campaign['id']}}/collaborator/{{ $collaborator['collaborator']['id']}}/answer" class="btn btn-success btn-xs pull-right">
                                            <i class="fa fa-check"></i> Give Feedback
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
                                <td class="project_progress" width="25%">
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57" aria-valuenow="56" style="width: 57%;"></div>
                                    </div>
                                    <small>57% Complete</small>
                                </td>
                                <td class="text-right">
                                    <a href="/user/campaign/{{ $campaign['id']}}/collaborator/{{ $collaborator['collaborator']['id']}}/answer" class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i> Give Feedback
                                    </a>
                                    <a href="/user/campaign/{{ $campaign['id']}}/collaborator/{{ $collaborator['collaborator']['id']}}/publish" class="btn btn-primary btn-xs">
                                        <i class="fa fa-arrow-up"></i> Review and Submit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>

        </div>

    </div>


@stop

@section('js')

@stop