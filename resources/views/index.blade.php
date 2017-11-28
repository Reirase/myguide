@extends('welcome')

@section('content')
    
            <div class="row">
            @foreach($wisatas as $wisata)
                <div class="col-sm-4 col-lg-4 col-md-4">
                  <div class="thumbnail">
                    <img src="uploads/image(2).jpg">
                    <div class="caption">
                        <h4><a href="{{url('wisata/'.$wisata->id)}}">{{$wisata->name}}</a></h4>
                        <p>{{$wisata->description}}</p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right">{{$wisata->name}} </p>
                        <p>
                            @for ($i=1; $i <= 5 ; $i++)
                                <span class="glyphicon glyphicon-star{{ ($i <= 2) ? '' : '-empty'}}"></span>
                            @endfor
                        </p>
                    </div>
                  </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@stop