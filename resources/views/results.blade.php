@extends('layout.app')

@section('content')
    <h1 class="mb-5">Matching Results for {{ ucfirst(str_replace('_', ' ', $column)) }}</h1>

    @if(empty($matches))
        <div class="alert alert-danger text-center" role="alert">
            There were no matching results
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Matching Data ID</th>
                <th>Description</th>
                <th>Mapping Data ID</th>
                <th>Condition Reason</th>
                <th>Main Data ID</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($matches as $match)
                <tr>
                    <td>{{ $match['matching_data_id'] }}</td>
                    <td>{{ $match['description'] }}</td>
                    <td>{{ $match['mapping_data_id'] }}</td>
                    <td>{{ $match['condition_reason'] }}</td>
                    <td>{{ $match['main_data_id'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection
