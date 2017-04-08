<nav class="navbar  navbar-inverse" id="main-navbar">
    <div class="container container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"> Menu</span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
            <span class="icon-bar"> </span>
        </button>

        {{ image("img/logo200.png", 'class': 'navbar-brand') }}
        <a class="navbar-brand" href="{{ url(['for': 'homepage']) }}"> QR Code</a>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url(['for': 'help']) }}">Pomoc</a></li>
                <li><a href="{{ url(['for': 'contact']) }}">Kontakt</a></li>
                {% if session.get('user') is null %}
                    <li><a href="{{ url(['for': 'login']) }}">Zaloguj</a></li>
                {% else %}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown"> Profil
                            <b class="caret"> </b>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">{{ session.get('user')['email'] }}</li>
                                <li><a href="{{ url(['for': 'panel']) }}">Panel</a></li>
                                <li><a href="{{ url(['for': 'logout']) }}">Wyloguj</a></li>
                            </ul>
                        </a>
                    </li>
                {% endif %}
            </ul>
        </div>
    </div>
</nav>