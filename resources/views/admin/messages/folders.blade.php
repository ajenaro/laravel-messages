<div class="card">
    <div class="card-header">
        <h3 class="card-title">Folders</h3>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item active">
                <a href="{{ route('admin.messages.index') }}" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.sent.index') }}" class="nav-link">
                    <i class="far fa-paper-plane"></i> Send
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.trash.index') }}" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                </a>
            </li>
        </ul>
    </div>
    <!-- /.card-body -->
</div>
