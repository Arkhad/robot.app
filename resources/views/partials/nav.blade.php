<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Logo</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li class="{{$currentId == 'home'? 'active' : 'no-active'}}" >
                <a  href="{{route('home')}}">Accueil</a>
            </li>
            @forelse($categories as $category)
            <li class="{{$currentId == $category->id? 'active' : 'no-active'}}">
                <a href="{{url('category', $category->id)}}">{{$category->title}} </a>
            </li>
            @empty
            <li>Aucune catégorie</li>
            @endforelse
            @if(auth()->check()) {{-- test si vous êtes connecté --}}
            <li>
                <a href="{{route('logout')}}">Se déconnecté</a>
            </li>
            <li>
                <a href="{{url('dashboard')}}">dashboard</a>
            </li>
            @else
            <li>
                <a href="{{route('login')}}">Login</a>
            </li>
            @endif
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li class="{{$currentId == 'home'? 'active' : 'no-active'}}" >
                <a href="{{route('home')}}">Accueil</a>
            </li>
            @forelse($categories as $category)
            <li class="{{$currentId == $category->id? 'active' : 'no-active'}}">
                <a href="{{url('category', $category->id)}}">{{$category->title}}</a>
            </li>
            <li>Aucune catégorie</li>
            @empty
            <li>Aucune catégorie</li>
            @endforelse
            @if(auth()->check()) {{-- test si vous êtes connecté --}}
            <li>
                <a href="{{route('logout')}}">Se déconnecté</a>
            </li>
            <li>
            <a href="{{url('dashboard')}}">Dashboard</a>
            </li>
            @else
            <li>
                <a href="{{route('login')}}">Login</a>
            </li>
            @endif
        </ul>
    </div>
</nav>