@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clients@index</div>

                    <div class="card-body">

                        <table class="ui small single line selectable table">
                            <thead>
                                <tr class="center aligned">
                                    <th class="one wide">#</th>
                                    <th class="two wide"></th>
                                    <th class="four wide">Name</th>
                                    <th class="four wide">Phone</th>
                                    <th class="three wide">E-mail</th>
                                    <th class="two wide"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr class="center aligned">
                                        <td class="middle aligned">
                                            <a>#{{ $client->id }}</a>
                                        </td>
                                        <td class="middle aligned">
                                            <h2 class="ui image bordered header">
                                                @if($client->photo)
                                                    <img class="ui mini rounded image"
                                                         src="{{ asset('/storage/' . $client->photo->filename) }}">
                                                @else
                                                    <img class="ui mini rounded image"
                                                         src="{{ asset('/assets/images/wireframe/image.png') }}">
                                                @endif
                                            </h2>
                                        </td>

                                        <td class="middle aligned">{{ $client->name }}</td>
                                        <td class="middle aligned">{{ $client->phone }}</td>
                                        <td class="middle aligned">
                                            <a href="#">{{ $client->email }}</a>
                                        </td>
                                        <td class="middle aligned">
                                            <a class="ui compact tiny icon right labeled icon button"
                                               href="{{ route('clients.show', ['client' => $client]) }}">
                                                <i class="edit icon"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            @if($clients->hasPages())
                                <tfoot>
                                    <tr class="center aligned">
                                        <th colspan="6">
                                            {{ $clients->links('vendor.pagination.semantic-ui') }}
                                        </th>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>

                        <div class="ui basic segment" style="text-align: center;">
                            <a class="ui small primary button" href="{{ route('clients.create') }}">
                                <i class="plus circle icon"></i> Add client
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
