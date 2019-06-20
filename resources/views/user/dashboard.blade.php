@extends('layouts.user')

@section('content')
    <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Dashboard<small>Activity report</small></h2>
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
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">

                            <img class="img-responsive avatar-view" src="/images/img.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                    </div>
                    <h3>Samuel Doe</h3>
                    <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                        </li>
                        <li>
                            <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                        </li>
                        <li class="m-top-xs">
                            <i class="fa fa-external-link user-profile-icon"></i>
                            <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                        </li>
                    </ul>
                    <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                    <br>

                    <h4>Skills</h4>
                    <ul class="list-unstyled user_data">
                        <li>
                            <p>Web Applications</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" aria-valuenow="49" style="width: 50%;"></div>
                            </div>
                        </li>
                        <li>
                            <p>Website Design</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70" aria-valuenow="69" style="width: 70%;"></div>
                            </div>
                        </li>
                        <li>
                            <p>Automation &amp; Testing</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30" aria-valuenow="29" style="width: 30%;"></div>
                            </div>
                        </li>
                        <li>
                            <p>UI / UX</p>
                            <div class="progress progress_sm">
                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" aria-valuenow="49" style="width: 50%;"></div>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">

                    <h3>Pending Feedback</h3>
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 40%">Campaign</th>
                            <th>Progress</th>
                            <th style="width: 20%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($pendingCampaigns as $campaign)

                            <tr>
                                <td>
                                    {{ $campaign['name'] }}
                                    {{--<br>--}}
                                    {{--<small>Created {{ $campaign['created_at_f'] }}</small>--}}
                                    {{--<br>--}}
                                    {{--<small>Start At {{ $campaign['start_at_f'] }}</small>--}}
                                    {{--<br>--}}
                                    {{--<small>Ends At {{ $campaign['expire_at_f'] }}</small>--}}
                                </td>
                                <td class="project_progress">
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57" aria-valuenow="56" style="width: 57%;"></div>
                                    </div>
                                    <small>57% Complete</small>
                                </td>
                                <td class="text-right">
                                    <a href="/user/campaign/{{ $campaign['id']}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <a href="/user/campaign/{{ $campaign['id']}}/submit" class="btn btn-success btn-xs"><i class="fa fa-arrow-up"></i> Submit </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div>

                        <ul class="messages">
                            <li>
                                <img src="/images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br>
                                    <p class="url">
                                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                        <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection


