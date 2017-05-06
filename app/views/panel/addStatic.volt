{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <div>
        {{ partial("partials/menu/codeSelect") }}
    </div>

    <div>
        <form id="static-qr-form" method="post">
            <fieldset class="form-fieldset">

                <div class="form-row">
                    <label class="form-label" for="text">Tekst:</label>
                </div>


                {{ qr.render("text", {"class": "form-field", "placeholder": ""}) }}

                {% for message in qr.getMessagesFor("text") %}
                    <div class="form-error">{{ message }}</div>
                {% endfor %}
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-row">
                    <label class="form-label" for="fill">Kolor wypełnienia:</label>
                </div>

                <input type="color" name="fill" title="fill" value="#000000">
            </fieldset>

            <fieldset class="form-fieldset">
                <div class="form-row">
                    <label class="form-label" for="background">Kolor tła:</label>
                </div>
                
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

