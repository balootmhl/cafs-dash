@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Payment Links') }}</h1>
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
                            <h3 class="card-title">Create Payment Link (Invoicing)</h3>

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
                            <form action="{{ route('payment-links.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" name="customer_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="customer_email">Customer Email *</label>
                                            <input type="email" name="customer_email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="request_expiry_date">Expiry Date *</label>
                                            <input type="date" name="request_expiry_date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount">Amount *</label>
                                            <input type="number" name="amount" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="currency">Currency *</label>
                                            <select name="currency" id="currency" class="form-control" required>
                                                <option value="SAR" selected>SAR</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="" style="visibility: hidden !important;">Submit</label>
                                            <input type="submit" value="Create Payment Link" class="btn btn-primary btn-block">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Reference</th>
                                        <th>Amount</th>
                                        {{-- <th>Expire Date</th> --}}
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($links as $link)
                                    <tr>
                                        <td>{{ $link->customer_email }}</td>
                                        <td>{{ $link->merchant_reference }}</td>
                                        <td>{{ $link->amount }} {{ $link->currency }}</td>
                                        {{-- <td>{{ $link->request_expiry_date }}</td> --}}
                                        <td>{{ $link->link }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" title="Edit">
                                            {{-- <a href="{{ route('payment-links.edit', $link->id) }}" class="btn btn-primary btn-sm" title="Edit"> --}}
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="" method="POST" style="display: inline;">
                                            {{-- <form action="{{ route('payment-links.destroy', $link->id) }}" method="POST" style="display: inline;"> --}}
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer clearfix">
                            {{-- {{ $links->links() }} --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('scripts')
    @if ($message = Session::get('success'))
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr.success('{{ $message }}')
        </script>
    @endif
    @if(session('toast'))
        <script>
            toastr.{{ session('toast')['type'] }}('{{ session('toast')['message'] }}');
        </script>
    @endif
@endsection
