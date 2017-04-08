{% extends "index.volt" %}

{% block leftBox %}
    {{ partial("menu/userLeft") }}
{% endblock %}

{% block contentBox %}
    {{ content() }}
{% endblock %}