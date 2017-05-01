{% extends "layouts/stats.volt" %}

{% block contentBox %}
    <h4>Kod dynamiczny: {{ code.name }}</h4>

    {% if stats is empty %}
        Nie odnotowano jeszcze skanów kodu. Statystyki nie są dostępne.
    {% else %}
        <div id="chart_div" style="width: 700px; height: 240px;"></div>

        <div class="col-sm-6">
            <div id="platforms_chart" style="padding-top: 20px"></div>
        </div>
        <div class="col-sm-6">
            <div id="browser_chart" style="padding-top: 20px"></div>
        </div>

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
            var platforms = {{ platforms|json_encode }};
            var browsers = {{ browsers|json_encode }};
            var stats = {{ stats|json_encode }};
        </script>
    {% endif %}
{% endblock %}
