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
                                        <td class="mailbox-name">From: {{ $message->user->name }}</td>
                                    @endif
                                    @if($folder == 'sent')
                                        <td class="mailbox-name">To: {{ App\User::findMany($message->recipients->pluck('recipient_id'))->pluck('name')->implode(', ') }}</td>
                                    @endif
                                    <td class="mailbox-subject">
                                        Subject: <a href="{{ route('admin.messages.show', $message) }}">{{ $message->subject }}
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
                                            <form method="POST" action="{{ route('admin.trash.update', $message) }}" style="display: inline">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-info btn-xs" title="Restore">
                                                    <i class="fas fa-trash-restore"></i>
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
