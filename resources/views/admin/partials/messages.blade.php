@if($count = Auth::user()->newmessages()->count())
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">{{ $count }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @foreach(Auth::user()->newmessages() as $newmessage)
                <a href="{{ route('admin.messages.show', $newmessage) }}" class="dropdown-item">
                    <div class="media">
                        <img src="{{ Gravatar::get(App\User::find($newmessage->sender_id)->email) }}" alt="{{ App\User::find($newmessage->sender_id)->name }}"
                             class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ App\User::find($newmessage->sender_id)->name }}
                            </h3>
                            <p class="text-sm">{{ Str::limit($newmessage->subject, 20, '...') }}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $newmessage->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            @endforeach
            <a href="{{ route('admin.messages.index') }}" class="dropdown-item dropdown-footer">Mostrar todos</a>
        </div>
    </li>
@endif
