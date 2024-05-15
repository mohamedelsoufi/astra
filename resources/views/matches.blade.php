@extends('layout.app')

@section('content')
    <h1 class="mb-5">Select Column to Match</h1>
    <form action="{{ route('map') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select name="column" id="column" class="form-select" aria-label="Default select example">
                        @foreach ($columns as $column)
                            <option value="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Match</button>
            </div>
        </div>


    </form>
@endsection
