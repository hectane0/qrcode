{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <div>
        <p>Nazwa: {{ code.name }}</p>
        <p>Cel: <a href="{{ code.target }}">{{ code.target }}</a></p>
        <p>Url: {{ code.public_url }}</p>
        <p>Stworzony: {{ code.created_at }}</p>
        <p>Odwiedzin: {{ code.getVisitCount() }} (<a href="{{ url(['for': 'stats-details', 'id': code.id]) }}">Szczegółowe statystyki</a>)</p>
    </div>

    <div>
        <img src="/panel/show/{{ code.id }}">
    </div>

    <form action="{{ url(['for': 'download']) }}">
        <input id="id" name="id" type="hidden" value="{{ code.id }}">
        <input id="download" type="submit" value="Pobierz">
    </form>
{% endblock %}
