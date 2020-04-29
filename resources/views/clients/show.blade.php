@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clients@show</div>

                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="ui fluid small card" data-client-id="{{ $client->id }}">
                                    <div class="image">
                                        @if($client->photo)
                                            <img class="ui mini rounded image" src="{{ asset('/storage/' . $client->photo->filename) }}">
                                        @else
                                            <img class="ui mini rounded image" src="{{ asset('/assets/images/wireframe/image.png') }}">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <a class="header">{{ $client->name }}</a>
                                        <div class="meta">
                                            <span class="date">Joined {{ $client->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="description">{{ $client->memo }}</div>
                                    </div>
                                    <div class="extra content">
                                        <span class="left floated">
                                            <i class="phone alternate icon"></i>
                                            {{ $client->phone }}
                                        </span>
                                        <span class="right floated">
                                            <i class="envelope icon"></i>
                                            {{ $client->email }}
                                        </span>
                                    </div>
                                    <div class="ui small bottom attached buttons">
                                        <a class="ui button" href="{{ route('clients.edit', ['client' => $client]) }}">
                                            <i class="pencil alternate icon"></i> Edit
                                        </a>
                                        <div class="or"></div>
                                        <div class="ui button deleteClientBttn">
                                            <i class="trash alternate icon"></i> Delete
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
