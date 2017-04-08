<div>
    <p>Nazwa: {{ code.name }}</p>
    <p>Cel: <a href="{{ code.target }}">{{ code.target }}</a></p>
    <p>Url: {{ code.public_url }}</p>
    <p>Stworzony: {{ code.created_at }}</p>
</div>

<div>
    <img src="http://qrcode.dev:8080/panel/show/{{ code.id }}">
</div>

<form action="{{ url(['for': 'download']) }}">
    <input id="id" name="id" type="hidden" value="{{ code.id }}">
    <input id="download" type="submit" value="Pobierz">
</form>