@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{$form_url}}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            @if($User)
                                <input type="hidden" id="userid" name="userid" value="{{$User->id}}">
                                Editing: {{$User->name }}
                            @else
                                Create New User
                            @endif
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" aria-describedby="Name" placeholder="Name" value="{{old('name') ?? $User->name ?? null}}" required name="name">
                                        <span class="invalid-feedback" role="alert">
                                                <strong>test</strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : ''  }}" id="email" aria-describedby="emailHelp" placeholder="Email" value="{{old('email') ?? $User->email ?? null}}" required name="email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->default->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(!$User)
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : ''  }}" id="password" aria-describedby="Password" placeholder="Password" value="{{old('password') ?? null}}" required name="password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->default->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" aria-describedby="Password" placeholder="Confirm Password" value="{{old('password_confirmation') ?? null}}" required name="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{  $errors->default->first('password_confirmation')  }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="role_id">Role <span class="text-danger">*</span></label>
                                        <select name="role_id" id="role_id" class="custom-select {{ $errors->has('role_id') ? ' is-invalid' : '' }}" required >
                                            <option value=""></option>
                                            <option value="1" @if($User && $User->role_id == 1) selected @endif>Restricted</option>
                                            <option value="2" @if($User && $User->role_id == 2) selected @endif>View</option>
                                            <option value="3" @if($User && $User->role_id == 3) selected @endif>Edit</option>
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->default->first('role_id')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right" type="submit">Submit</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
