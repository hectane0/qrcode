{% extends "index.volt" %}

{% block leftBox %}
    {{ partial("partials/menu/userLeft") }}
{% endblock %}

{% block contentBox %}
    {{ content() }}
{% endblock %}