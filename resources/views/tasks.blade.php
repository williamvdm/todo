@extends('layouts.app')

@section('content')
    <h1 class="text-center lin">My to do</h1>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <h2>New task</h2>
                <div class="panel-body">
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <h5>Add new task to your task list</h5>
                            <div class="">
                                <input  type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}"placeholder="@include('common.errors')"></input>
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="col-sm-offset-2 col-sm-8">
            @if(count($tasks) === 0)
                <h2>Current tasks</h2>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <h4 class="pull-left">Task list</h4>
                            <h4 class="pull-right">No tasks in list</h4>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No tasks found. Try adding one.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($tasks) > 0)
                    <form action="{{ url('task/all') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger pull-right">Delete all</button>
                    </form>
                <h2>Current tasks</h2>
                    <div class="panel-body scrollbox" style="max-height: 100vh; overflow: auto">
                <table class="table" style="position: fixed">
                    <h4 class="pull-left">Task list</h4>
                    <h4 class="pull-right">{{ count($tasks) }} task(s) in list</h4>
                </table>
                        <table class="table table-striped">
                            <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="table-text"><div>{{ $task->name }}</div></td>
                                    <td class="table-text"><div class="pull-right">{{ $task->created_at }}</div></td>
                                    <td>
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
