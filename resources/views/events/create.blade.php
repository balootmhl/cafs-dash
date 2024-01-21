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
                            <h3 class="card-title">Edit Payment Link (Invoicing)</h3>

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
                            <form action="{{ route('events.store', $event->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="customer_name">Event Name</label>
                                            <input type="text" name="customer_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="category">Currency *</label>
                                            <select name="category" id="category" class="form-control" onchange="updateSubcategories()" required>
                                                <option value="" selected disabled>Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="subcategory">Currency *</label>
                                            <select name="subcategory" id="subcategory" class="form-control"  required>
                                                <option value="" selected disabled>Select a category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" class="form-control"  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount">Amount *</label>
                                            <input type="number" name="amount" value="{{ $event->amount }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" style="visibility: hidden !important;">Submit</label>
                                            <input type="submit" value="Update Payment Link" class="btn btn-primary btn-block">
                                        </div>
                                    </div>
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
            var categoryId = document.getElementById("category").value;
            var subcategoryDropdown = document.getElementById("subcategory");

            // Remove existing options
            subcategoryDropdown.innerHTML = "<option value='' selected disabled>Select a subcategory</option>";

            // Fetch subcategories based on the selected category
            var subcategories = getSubcategories(categoryId);

            // Populate subcategory dropdown
            subcategories.forEach(function(subcategory) {
                var option = document.createElement("option");
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategoryDropdown.add(option);
            });

            // Enable the subcategory dropdown
            subcategoryDropdown.disabled = false;
        }

        // Mock function to fetch subcategories from the server
        function getSubcategories(categoryId) {
            // This is where you would make an AJAX request to your server to fetch subcategories based on the category
            // For now, let's assume you have a hardcoded list for demonstration purposes.
            var subcategories = [
                { id: 1, name: "Subcategory 1-1" },
                { id: 2, name: "Subcategory 1-2" },
                // Add more subcategories as needed
            ];

            return subcategories;
        }
    </script>
@endsection
