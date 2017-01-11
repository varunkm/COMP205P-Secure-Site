
@extends('layouts.app')

@section('content')

<div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New snippet Form -->
        <form action="{{ route('createSnippet') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}

            <!-- snippet Name -->
            <div class="form-group">
                <label for="snippet-name" class="col-sm-3 control-label">Text</label>

                <div class="col-sm-6">
                    <input type="text" name="text" id="snippet-text" class="form-control">
                </div>
            </div>

            <!-- Add Snippet Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Snippet
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (count($snippets) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Snippets
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Snippet</th>
                        <th>Author</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($snippets as $snippet)
                            <tr>
                                <!-- Snippet Name -->
                                <td class="table-text">
                                    <div>{{ $snippet->text }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ (App\User::select('name')->where('id', $snippet->user_id)->first())['name'] }}</div>
                                </td>

                                <td>
                                  <form action="/snippet/{{ $snippet->id }}" method="POST">
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}

                                          <button>Delete Snippet</button>
                                      </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
