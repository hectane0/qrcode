<div>
    Ranking:
</div>

<div>
    {% for rank in ranking %}
    <p>{{ loop.index }}. <a href="{{ url(['for': 'stats-details', 'id': rank['id']]) }}">{{ rank['name'] }}</a> - {{ rank['total'] }}</p>
    {% endfor %}
</div>