{% extends "layouts/panel.volt" %}

{% block contentBox %}
    Moje kody dynamiczne:
    {% for code in codes %}
        <div>
            <a href="{{ url(['for': 'code-details', 'id': code.id]) }}">{{ code.name }}</a>
        </div>
    {% endfor %}
{% endblock %}
