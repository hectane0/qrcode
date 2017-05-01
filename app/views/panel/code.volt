{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <h3>Kod skryptu generującego kod QR:</h3>
    <pre><code class="python">{{ code }}</code></pre>
{% endblock %}
