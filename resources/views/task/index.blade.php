@extends('layouts.app')

@section('content')

<div class="container">
    @if (\Session::has('success'))
        <div class="alert alert-success">
            {{ \Session::get('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if(isset($task))
                <div class="card-header">Edit Task</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/task/updateTask/'.$task['id']) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task['name'] }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="card-header">New Task</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/task/create') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tasks') }}</div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <tbody>
                                @foreach ($taskData as $taskDatas)
                                    <tr>
                                        @if ($taskDatas->is_complete == 1)
                                            <td>{{ $taskDatas->name }}</td>
                                            <td>
                                                <a href="{{ url('/task/update/'.$taskDatas->id.'/0') }}">
                                                    <button type="button" class="btn btn-success btn-xs">Complete</button>
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <strike>{{ $taskDatas->name }}</strike>
                                            </td>
                                            <td>
                                                <a href="{{ url('/task/update/'.$taskDatas->id.'/1') }}">
                                                    <button type="button" class="btn btn-primary btn-xs">Uncomplete</button>
                                                </a>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ url('/task/editTask/'.$taskDatas->id) }}">
                                                <button type="button" class="btn btn-info btn-xs">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/task/delete/'.$taskDatas->id) }}">
                                                <button type="button" class="btn btn-danger btn-xs">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
