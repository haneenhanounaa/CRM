@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Change Stage for Lead: {{ $lead->name }}</h1>
    <form action="{{ route('leads.updateStage', $lead) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="stage_id" class="form-label">Select Stage</label>
            <select name="stage_id" id="stage_id" class="form-select" required>
                <option value="" disabled selected>Select a stage</option>
                @foreach ($stages as $stage)
                    <option value="{{ $stage->id }}" {{ $lead->stage_id == $stage->id ? 'selected' : '' }}>
                        {{ $stage->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Stage</button>
        <a href="{{ route('leads.show', $lead) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
