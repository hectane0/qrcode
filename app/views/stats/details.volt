<h4>Kod dynamiczny: {{ code.name }}</h4>

<div id="chart_div"></div>

<div>Ostatnie 5 skanów:</div>
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