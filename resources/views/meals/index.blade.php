@extends('layouts.admin')

@section('content')
<div class="row">
    <!-- Add Meal Form -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add Meal</div>
            <div class="card-body">
                <form action="{{ route('meals.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Meal Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save Meal</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Meals Table -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">All Meals</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal->id }}</td>
                            <td>{{ $meal->name }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $meal->category->name }}</span>
                            </td>
                            <td>${{ number_format($meal->price, 2) }}</td>
                            <td>
                                <form action="{{ route('meals.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('Delete this meal?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection