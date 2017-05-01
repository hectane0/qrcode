{% extends "layouts/stats.volt" %}

{% block contentBox %}
    <h4>Kod dynamiczny: {{ code.name }}</h4>

    {% if stats is empty %}
        Nie odnotowano jeszcze skanów kodu. Statystyki nie są dostępne.
    {% else %}
        <div id="chart_div" style="width: 700px; height: 240px;"></div>


        <div>Ostatnie skany:</div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th>Czas</th>
                    <th>Useragent</th>
                </tr>
                </thead>
                <tbody>
                {% for last in lasts %}
                    <tr>
                        <td>{{ last.date }}</td>
                        <td title="{{ last.useragent }}">{{ last.useragent }}</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>

        <script>
            var stats = {{ stats|json_encode }};
        </script>
    {% endif %}
{% endblock %}




{% block rightBox %}
    Dupa
{% endblock %}