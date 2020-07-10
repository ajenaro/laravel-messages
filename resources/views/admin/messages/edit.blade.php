@extends('admin.layouts.layout')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('admin.messages.create') }}" class="btn btn-primary btn-block mb-3">New Message</a>
            @include('admin.messages.folders')
        <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Reply Message</h3>
                </div>
                <!-- /.card-header -->
                <form method="POST" action="{{ route('admin.reply.update', $message) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group">

                            <label>To:</label>
                            <select name="sender_id[]"
                                    class="form-control select2bs4"
                                    multiple="multiple">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $message->sender_id == $user->id ? ' selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject"
                                   class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}"
                                   placeholder="Subject"
                                   value="{{ old('subject', $message->subject) }}">
                            {!! $errors->first('subject', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <label for="editor">Message:</label>
                        <div class="form-group">
                            <textarea name="body" id="editor"
                                      class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                                      placeholder="Contenido del mensaje">{{ old('body') }}</textarea>
                            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                        </div>
                        <a href="{{ route('admin.messages.show', $message) }}"  class="btn btn-default"><i class="fas fa-times"></i> Cancel</a>
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
    <!-- summernote -->
    <link rel="stylesheet" href="/adminlte/plugins/summernote/summernote-bs4.css">
@endpush

@push('scripts')
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Summernote -->
    <script src="/adminlte/plugins/summernote/summernote-bs4.min.js"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })

        $('#editor').summernote({
            placeholder: 'Type the message content',
            tabsize: 2,
            height: 250,
        });

    </script>
@endpush
