{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <div>
        {{ partial("partials/menu/codeSelect") }}
    </div>

    <div>
        <form id="static-qr-form" method="post">
            <fieldset>
                <label for="text">Tekst:</label>
                {{ qr.render("text", {"class": "", "placeholder": "Tekst"}) }}
                {% for message in qr.getMessagesFor("text") %}
                    <div class="error">{{ message }}</div>
                {% endfor %}
            </fieldset>

            <fieldset>
                <label for="fill">Kolor wypełnienia:</label>
                <input type="color" name="fill" title="fill" value="#000000">
            </fieldset>

            <fieldset>
                <label for="background">Kolor tła:</label>
                <input type="color" name="background" title="background" value="#ffffff">
            </fieldset>

            <input type="button" id="generate" value="Generuj">

        </form>

        <div id="qr-code"></div>
        <form action="{{ url(['for': 'download']) }}" method="post">
            <input id="b64" name="b64" type="hidden" value="">
            <input id="download" style="display: none" type="submit" value="Pobierz">
        </form>

    </div>
{% endblock %}

