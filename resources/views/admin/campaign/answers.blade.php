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

    {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
        {{--<div class="x_panel">--}}
            {{--<div class="x_title">--}}
                {{--<h2>Line graph<small>Sessions</small></h2>--}}
                {{--<ul class="nav navbar-right panel_toolbox">--}}
                    {{--<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Settings 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Settings 2</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a class="close-link"><i class="fa fa-close"></i></a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<div class="clearfix"></div>--}}
            {{--</div>--}}
            {{--<div class="x_content">--}}
                {{--<canvas id="lineChart"></canvas>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pontuação das Respostas<small>quantidade de votos por pontuação</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="mybarChart"></canvas>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Perguntas, Respostas e Comentários<small>por Colaborador</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @foreach ($questions as $question)

                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $question['question']['question'] }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($question['answers'] as $answerId => $answerContent)
                                <ul class="messages">
                                    <li>
                                        <img src="{{ $answerContent['collaborator']['picture']  }}" class="avatar" alt="Avatar">
                                        <div class="message_wrapper">
                                            <h4 class="heading">
                                                {{ $answerContent['collaborator']['name'] }}
                                            </h4>
                                            @if (!empty($answerContent['comment']))
                                            <blockquote class="message">
                                                <span class="label label-{{ $resultsColor[$answerContent['result']] }} ">{{ $results[$answerContent['result']] }}</span>
                                                {{ $answerContent['comment'] }}
                                            </blockquote>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="clearfix"></div>


@stop

@section('js')
    <script>
        $(document).ready(function () {
            // if($("#lineChart").length){
            //     var f=document.getElementById("lineChart");
            //     new Chart(f,{
            //         type:"line",
            //         data:{
            //             labels:["January","February","March","April","May","June","July"],
            //             datasets:[{
            //                 label:"My First dataset",
            //                 backgroundColor:"rgba(38, 185, 154, 0.31)",
            //                 borderColor:"rgba(38, 185, 154, 0.7)",
            //                 pointBorderColor:"rgba(38, 185, 154, 0.7)",
            //                 pointBackgroundColor:"rgba(38, 185, 154, 0.7)",
            //                 pointHoverBackgroundColor:"#fff",
            //                 pointHoverBorderColor:"rgba(220,220,220,1)",
            //                 pointBorderWidth:1,
            //                 data:[31,74,6,39,20,85,7]
            //             },{
            //                 label:"My Second dataset",
            //                 backgroundColor:"rgba(3, 88, 106, 0.3)",
            //                 borderColor:"rgba(3, 88, 106, 0.70)",
            //                 pointBorderColor:"rgba(3, 88, 106, 0.70)",
            //                 pointBackgroundColor:"rgba(3, 88, 106, 0.70)",
            //                 pointHoverBackgroundColor:"#fff",
            //                 pointHoverBorderColor:"rgba(151,187,205,1)",
            //                 pointBorderWidth:1,
            //                 data:[82,23,66,9,99,4,2]
            //             }]
            //         }
            //     });
            // }
            if($("#mybarChart").length){
                var f=document.getElementById("mybarChart");
                new Chart(f,{
                    type:"bar",
                    data:{
                        labels:["Inaceitável","Péssimo","Ruim","Regular","Bom","Ótimo","Excelente"],
                        datasets:[{
                            label:"Votos",
                            backgroundColor:"#26B99A",
                            data: {!!  json_encode($campaignQuestionsChart) !!}
                        }]
                    },options:{
                        scales:{
                            yAxes:[{
                                ticks:{
                                    beginAtZero:!0
                                }
                            }]
                        }
                    }
                })
            }
        });
    </script>

@stop

