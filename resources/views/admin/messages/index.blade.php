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
                    <h3 class="card-title">{{ $folder }}</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            @forelse($messages->load('recipients') as $message)
                                <tr>
                                    @if($folder == 'inbox')
                                        <td class="mailbox-name">De: {{ App\User::find($message->sender_id)->name }}</td>
                                    @endif
                                    <td class="mailbox-subject">
                                        <a href="{{ route('admin.messages.show', $message) }}">
                                            {{ $message->subject }}
                                        </a>
                                    </td>
                                    <td class="mailbox-date">{{ $message->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if($folder == 'inbox')
                                            <form method="POST" action="{{ route('admin.messages.update', $message) }}" style="display: inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-info btn-xs"
                                                        title="{{ is_null($message->recipients[0]->read_at) ? 'Mark as read' : 'Mark as unread' }}">
                                                    <i class="fas {{ $message->recipients[0]->read_at ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                                </button>
                                            </form>
                                        @elseif($folder == 'trash')
                                            <form method="POST" action="{{ route('admin.trashmessages.update', $message) }}" style="display: inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-info btn-xs" title="Restore">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.trashmessages.destroy', $message) }}" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-xs" title="Eliminar"
                                                        onclick="return confirm('¿Estás seguro/a?')">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        You have not messages
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
