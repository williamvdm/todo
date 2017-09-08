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
            @if (count($tasks) > 0)
                    <form action="{{ url('task/all') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger pull-right">Delete all</button>
                    </form>
                <h2>Current tasks</h2>
                    <div class="panel-body scrollbox" style="max-height: 100vh; overflow: auto">
                <table class="table" style="position: fixed">
                    <h4 class="pull-left">Task list</h4>
                </table>
                        <table class="table table-striped">
                            <tbody>
                            @foreach ($tasks as $task)
                                @if(!$task->done)
                                <tr>
                                    <td class="table-text"><div>{{ $task->name }}</div></td>
                                    <td class="table-text"><div class="pull-right">{{ $task->created_at }}</div></td>
                                    <td>
                                        <form action="{{ url('task/'.$task->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger pull-right">Delete</button>
                                        </form>
                                        <form action="{{ url('task/' . $task->id) }}" method="post">
                                            <button type="submit" class="btn btn-success">Done</button>
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @if ($tasks->count())
            <div class="col-sm-offset-2 col-sm-8">
            <h2>Done</h2>
            <div class="panel-body">
                <table class="table">
                    <h4 class="pull-left">Task list</h4>
                </table>
                <table class="table table-striped">
                    <tbody>
                    @foreach ($tasks as $task)
                        @if($task->done)
                        <tr>
                            <td class="table-text"><div>{{ $task->name }}</div></td>
                            <td class="table-text"><div class="pull-right">{{ $task->updated_at }}</div></td>
                            <td>
                                <form action="{{ url('task/' . $task->id) }}" method="post" class="pull-right">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                                <form action="{{ url('task/undo/' . $task->id) }}" method="post">
                                    <button type="submit" class="btn btn-success">Undo</button>
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        @endif
        </div>
    </div>
@endsection
