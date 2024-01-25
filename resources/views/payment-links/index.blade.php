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

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="card-header">
                                {{-- <div class="card-tools"> --}}
                                    <a href="{{ route('payment-links.create') }}" class="btn btn-primary btn-sm">Create Payment Link</a>
                                {{-- </div> --}}
                                <!-- /.card-tools -->
                            </div>

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
                                            <div class="btn-group">
                                                <a href="{{ route('payment-links.show', $link->id) }}" class="btn btn-primary btn-sm" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('payment-links.destroy', $link->id) }}" method="POST">
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


