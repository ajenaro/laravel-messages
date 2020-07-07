@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Compose New Message</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('admin.messages.store') }}">
                    @csrf

                    <div class="card-body">

                        <label>To:</label>
                        <div class="form-group">
                            <select name="recipients[]"
                                    class="form-control select2bs4 {{ $errors->has('recipients') ? 'is-invalid' : '' }}"
                                    multiple="multiple"
                                    data-placeholder="Select recipient/s">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ collect(old('recipients', $message->recipients->pluck('recipient_id')))->contains($user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('recipient_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        @include('admin.messages._fields')

                        <label for="editor">Message:</label>
                        <div class="form-group">
                            <textarea name="body" id="editor" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body') }}</textarea>
                            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Send Message</button>
                        </div>

                    </div>

                </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.css">
@endpush

@push('scripts')
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })

        $('#editor').summernote({
            placeholder: 'Escribe el contenido del mensaje',
            tabsize: 2,
            height: 250,
        });

    </script>
@endpush
