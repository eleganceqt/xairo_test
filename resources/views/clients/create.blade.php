@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clients@create</div>
                    <div class="card-body">

                        <form class="ui small form" method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
                            <div class="field {{ $errors->has('name') ? 'error': '' }}">
                                <label>Name</label>
                                <input type="text" name="name" autocomplete="off">
                            </div>
                            <div class="field {{ $errors->has('phone') ? 'error': '' }}">
                                <label>Phone</label>
                                <input type="text" name="phone" autocomplete="off">
                            </div>
                            <div class="field {{ $errors->has('email') ? 'error': '' }}">
                                <label>E-mail</label>
                                <input type="text" name="email" autocomplete="off">
                            </div>
                            <div class="field">
                                <label>Memo</label>
                                <textarea name="memo"></textarea>
                            </div>
                            <div class="field {{ $errors->has('photo') ? 'error': '' }}">
                                <label>Photo</label>
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
                                <button class="ui small primary button" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
