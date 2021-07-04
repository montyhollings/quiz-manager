@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($Users as $user)
                                      <tr>
                                          <td>{{$user->name}}</td>
                                          <td>{{$user->role->description}}</td>
                                          <td>{{$user->created_at_date_display}}</td>
                                          <td>
                                              <div class="btn-group btn-group-sm" role="group" >
                                                  <a href="{{route('users.edit', [$user->id])}}" class="btn btn-warning">Edit</a>
                                                  <a href="{{route('users.delete', [$user->id])}}" class="btn btn-danger">Delete</a>
                                              </div>
                                          </td>
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('users.create')}}" class="btn btn-success float-right">Create User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
