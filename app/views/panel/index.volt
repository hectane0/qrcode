{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <div>
        Ostatni skan: {{ last['date'] }} ({{ last['name'] }})
    </div>

    <div>
        Najpopularniejszy kod: {{ popular['name'] }} ({{ popular['count'] }} skanów)
    </div>
{% endblock %}
