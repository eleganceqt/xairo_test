@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clients@edit</div>
                    <div class="card-body">
                        <form class="ui small form" method="POST"
                              action="{{ route('clients.update', ['client' => $client]) }}"
                              enctype="multipart/form-data" data-client-id="{{ $client->id }}">

                            @method('PUT')

                            <div class="field {{ $errors->has('name') ? 'error': '' }}">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $client->name }}" autocomplete="off">
                            </div>
                            <div class="field {{ $errors->has('phone') ? 'error': '' }}">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{ $client->phone }}" autocomplete="off">
                            </div>
                            <div class="field {{ $errors->has('email') ? 'error': '' }}">
                                <label>E-mail</label>
                                <input type="text" name="email" value="{{ $client->email }}" autocomplete="off">
                            </div>
                            <div class="field">
                                <label>Memo</label>
                                <textarea name="memo">{{ $client->memo }}</textarea>
                            </div>
                            <div class="field {{ $errors->has('photo') ? 'error': '' }}">
                                <label>Photo</label>
                                @if($client->photo)
                                    <div class="ui card">
                                        <a class="image" href="#">
                                            <img class="ui medium rounded image"
                                                 src="{{ asset('/storage/' . $client->photo->filename) }}">
                                        </a>
                                        <div class="ui bottom attached ui small compact button deletePhotoBttn">
                                            <i class="minus circle icon"></i> Delete
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="field">
                                <input type="file" name="photo" accept="image/*">
                            </div>

                            @csrf

                            @if($errors->any())
                                <div class="ui error visible message">
                                    <ul class="list">
                                        @foreach($errors->all() as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="ui basic center aligned segment" style="text-align: center;">
                                <button class="ui small primary button" type="submit">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
