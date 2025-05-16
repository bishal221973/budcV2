@extends('layouts.app')

@section('content')
    @if (session('success'))
        @push('script')
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: @json(session('success'))
                });
            </script>
        @endpush
    @endif

    @if ($fiscalYear?->id)
        @push('script')
            <script>
                $("#exampleModalCenter").modal('show')
            </script>
        @endpush
    @endif

    <div class="container">
        <div class="d-flex justify-content-between py-1 align-items-center">
            <x-breadcrumb :breadcrumbs="[['title' => 'Settings', 'url' => route('setting.index')], ['title' => 'General Settings']]" />
            <button class="btn btn-info add-btn" data-toggle="modal" data-target="#exampleModalCenter"><i
                    class="fa fa-plus"></i> Add</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Status</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($fiscalYears as $fiscalyear)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $fiscalyear->name }}</td>
                                            <td>{{ $fiscalyear->from }}</td>
                                            <td>{{ $fiscalyear->to }}</td>
                                            <td>
                                                @if ($fiscalyear->status)
                                                    <div class="badge badge-success">Active</div>
                                                @else
                                                    <div class="badge badge-secondary">Deactive</div>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('fiscal.year.edit', $fiscalyear) }}"
                                                    class="mr-2 btn btn-outline-warning btn-sm"><i
                                                        class="fa fa-pen"></i></a>
                                                <form action="{{ route('fiscal.year.delete', $fiscalyear) }}"
                                                    onsubmit="return confirm('Are you sure ?')" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-danger btn-sm" type="submit"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$fiscalYear?->id ? 'Edit' : 'New'}} Fiscal Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ $fiscalYear?->id ? route('fiscal.year.update',$fiscalYear) : route('fiscal.year.store') }}" method="POST">
                        @csrf
                        @isset($fiscalYear?->id)
                            @method('put')
                        @endisset
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" value="{{ old('name', $fiscalYear->name) }}"
                                class="form-control" placeholder="Fiscal Year Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">From *</label>
                            <input type="text" name="from" value="{{ old('from', $fiscalYear->from) }}"
                                class="form-control date-picker" placeholder="YYYY-MM-DD">
                            @error('from')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">To *</label>
                            <input type="text" name="to" value="{{ old('to', $fiscalYear->to) }}"
                                class="form-control date-picker" placeholder="YYYY-MM-DD">
                            @error('to')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Status *</label>
                            <select name="status" class="form-control form-select">
                                <option value="">Select an option</option>
                                <option value="1" {{$fiscalYear?->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$fiscalYear?->status == 0 ? 'selected' : ''}}>Deactive</option>
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-end">
                            <button class="btn btn-info">{{$fiscalYear?->id ? 'Update' : 'Save'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
