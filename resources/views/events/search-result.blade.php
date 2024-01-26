@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Events') }} - Search Results</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="btn-group">
                                <a href="{{ route('events.index') }}" class="btn btn-primary mr-1">Back</a>
                                <a href="{{ route('events.create') }}" class="btn btn-primary">Create an Event</a>
                            </div>
                            <div class="card-tools">
                                <form class="form-inline" action="{{ route('events.search') }}" method="POST">
                                    @csrf
                                    <select name="main_category" id="main_category" onchange="updateSubcategories()" class="form-control mr-1">
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $selected_main->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <select name="sub_category" id="sub_category" class="form-control mr-1">
                                        <option value="" disabled>Select Sub-Category</option>
                                        @foreach ($selected_main->children as $child)
                                            <option value="{{ $child->id }}" @if($child->id == $selected_sub->id) selected @endif>{{ $child->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#SR</th>
                                        <th>Name</th>
                                        <th>Datetime</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->datetime }}</td>
                                        <td></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary btn-sm" title="Edit" style="margin-right:5px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{-- {{ $events->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        function updateSubcategories() {
            var mainCategoryId = document.getElementById("main_category").value;
            var subcategoryDropdown = document.getElementById("sub_category");

            // Disable the subcategory dropdown
            subcategoryDropdown.disabled = true;

            // Remove existing options
            subcategoryDropdown.innerHTML = "<option value='' selected disabled>Select Sub-Category</option>";

            // Fetch subcategories based on the selected main category
            fetch('/get-subcategories/' + mainCategoryId)
                .then(response => response.json())
                .then(subcategories => {
                    // Populate subcategory dropdown
                    subcategories.forEach(subcategory => {
                        var option = document.createElement("option");
                        option.value = subcategory.id;
                        option.text = subcategory.name;
                        subcategoryDropdown.add(option);
                    });

                    // Enable the subcategory dropdown
                    subcategoryDropdown.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching subcategories:', error);
                });
        }
    </script>
@endsection
