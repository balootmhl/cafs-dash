@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Events') }}</h1>
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

                    {{-- <div class="alert alert-info">
                        Sample table page
                    </div> --}}
                    <div class="card card-outline card-primary">
                        {{-- <div class="overlay dark">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div> --}}
                        <div class="card-header">
                            <h3 class="card-title">Edit Event</h3>

                            <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <!-- This will cause the card to collapse when clicked -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <!-- This will cause the card to be removed when clicked -->
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> --}}
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('events.update', $event->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Event Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="main_category">Main Category</label>
                                            <select name="main_category" id="main_category" class="form-control" onchange="updateSubcategories()" required>
                                                <option value="" disabled>Select main category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if($event->category->parent->id == $category->id) selected @endif>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="sub_category">Sub Category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="" disabled>Select subcategory</option>
                                                @foreach ($event->category->parent->children as $subcat)
                                                    <option value="{{ $subcat->id }}" @if ($subcat->id == $event->category_id) selected @endif>{{ $subcat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="datetime">Date</label>
                                            <input type="datetime-local" name="datetime" id="datetime" class="form-control" value="{{ $event->datetime }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="10" class="form-control">{{ $event->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update Event" class="btn btn-primary">
                                </div>
                            </form>
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
            subcategoryDropdown.innerHTML = "<option value='' selected disabled>Select subcategory</option>";

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
