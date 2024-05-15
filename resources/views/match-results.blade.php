@extends('layout.app')

@section('content')
    <h1 class="mb-5">Matching Results</h1>

    @if(!$results)
        <div class="alert alert-danger text-center" role="alert">
            There were no matching results
        </div>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Arabic</th>
                <th>Table 2 ID</th>
                <th>Reason</th>
                <th>Table 1 ID</th>
                <th>English</th>
                <th>Table 2 ID</th>
                <th>Reason</th>
                <th>Table 1 ID</th>
                <th>Latin</th>
                <th>Table 2 ID</th>
                <th>Reason</th>
                <th>Table 1 ID</th>
                <th>Matching Results</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result['id'] }}</td>
                    <td>{{ $result['arabic']['description'] ?? '' }}</td>
                    <td>{{ $result['arabic']['mapping_data_id'] ?? '' }}</td>
                    <td>{{ $result['arabic']['condition_reason'] ?? '' }}</td>
                    <td>{{ $result['arabic']['main_data_id'] ?? '' }}</td>
                    <td>{{ $result['english']['description'] ?? '' }}</td>
                    <td>{{ $result['english']['mapping_data_id'] ?? '' }}</td>
                    <td>{{ $result['english']['condition_reason'] ?? '' }}</td>
                    <td>{{ $result['english']['main_data_id'] ?? '' }}</td>
                    <td>{{ $result['latin']['description'] ?? '' }}</td>
                    <td>{{ $result['latin']['mapping_data_id'] ?? '' }}</td>
                    <td>{{ $result['latin']['condition_reason'] ?? '' }}</td>
                    <td>{{ $result['latin']['main_data_id'] ?? '' }}</td>
                    <td>{{ $result['matching_result'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
