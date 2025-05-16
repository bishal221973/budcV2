@extends('layouts.app')

@section('content')
    <div class="container">
        <x-breadcrumb :breadcrumbs="[['title' => 'Settings', 'url' => route('setting.index')], ['title' => 'General Settings']]" />


        <div class="card shadow mt-3 main-card">

            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Tests') }}</h6>
                    </div>
                    <div class="col-4">
                        {{-- <a href="{{ route('test.create') }}" class="btn btn-outline-primary btn-sm float-right"><i
                                    class="fa fa-plus"></i> {{ __('Add Test') }}</a>
                        --}}
                        <button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            <i class="fa fa-plus mr-1"></i>
                            Add Diagnostic Test
                        </button>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">{{ __('Test Name') }}</th>
                                <th class="text-center">Amount</th>
                                {{-- <th class="text-center">{{ __('Description') }}</th> --}}
                                <th class="text-center">{{ __('Total Use') }}</th>
                                <th class="text-center">{{ __('Report Format') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tests as $test)
                                <tr>
                                    <td class="text-center">{{ $test->id }}</td>
                                    <td class="text-center">{{ $test->test_name }}</td>
                                    <td class="text-center">Rs. {{ $test->amount }} /-</td>
                                    {{-- <td class="text-center"> {{ $test->comment ?? __('N/A') }} </td> --}}
                                    <td class="text-center"><label class="badge badge-primary-soft"><i
                                                class="fa fa-clock"></i>
                                            {{ __('In Prescription') }} : {{ $test->Prescription->count() }}
                                            {{ __('time use') }}</label></td>
                                    <td class="text-center">
                                        @if ($test?->ReportFormat?->id)
                                            <a target="__blank" href="{{ $test?->ReportFormat?->doc_url ?? '#' }}">Report
                                                Sample</a>
                                        @else
                                            <a href="{{ route('format-create', $test->id) }}">Create format</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('edit diagnostic test')
                                            <a href="{{ route('test.edit', ['id' => $test->id]) }}"
                                                class="btn btn-outline-warning btn-sm"><i class="fa fa-pen"></i></a>
                                        @endcan
                                        @can('delete diagnostic test')
                                            <a class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#DeleteModal"
                                                data-link="{{ route('test.delete', ['id' => $test->id]) }}"><i
                                                    class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('You don\'t have any Diagnosis Tests') }},
                                        <a href="{{ route('test.create') }}">{{ __('create one') }}</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Diagnostic Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('test.create') }}">
                        {{ csrf_field() }}
                        <div class="mb-1">
                            <label for="inputEmail3">{{ __('Test Name') }}<font color="red">*</font></label>
                            <input type="text" class="form-control" id="inputEmail3" name="test_name">

                        </div>
                        <div class="mb-1">
                            <label for="inputEmail3">Amount<font color="red">*</font></label>
                            <input type="number" class="form-control" id="inputEmail3" name="amount">

                        </div>
                        <div class="mb-1">
                            <label for="inputPassword3">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="inputPassword3" name="comment">

                        </div>
                        <div class="mb-1 d-flex justify-content-end">
                            <button type="submit" class="btn btn-info">{{ __('Save') }}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
