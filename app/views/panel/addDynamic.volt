{% extends "layouts/panel.volt" %}

{% block contentBox %}
    <div>
        {{ partial("partials/menu/codeSelect") }}
    </div>

    <form id="static-qr-form" class="form-container" method="post" enctype="multipart/form-data">

        <div class="form-description">
            <h4>Nowy kod dynamiczny</h4>
            <div>
                Kod dynamiczny pozwala na śledzenie skanowań kodu oraz tworzenie statystyk.
            </div>
        </div>


        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="name">Nazwa</label>
            </div>

            {{ qr.render("text", {"class": "form-field", "placeholder": ""}) }}

            {% for message in qr.getMessagesFor("text") %}
                <div class="form-error">{{ message }}</div>
            {% endfor %}

        </fieldset>


        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="target">Cel</label>
                <span data-toggle="tooltip" title="Adres www strony do której kod będzie prowadził. Musi rozpoczynać się od http://" class="glyphicon glyphicon-question-sign"></span>
            </div>


            {{ qr.render("target", {"class": "", "placeholder": ""}) }}

            {% for message in qr.getMessagesFor("target") %}
                <div class="error">{{ message }}</div>
            {% endfor %}
        </fieldset>

        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="url">Widoczny addres</label>
                <span data-toggle="tooltip" title="Adres który zobaczy osoba skanująca kod podczas skanowania" class="glyphicon glyphicon-question-sign"></span>
            </div>

            <div class="form-row">
                www.{{ request.getServer("HTTP_HOST") }}/
                {{ qr.render("url", {"class": "", "placeholder": "  "}) }}
                {{ qr.render("firstTry", {"value": ""}) }}
                <input type="button" id="check-occupied" value="Sprawdź dostępność">
            </div>

            <div class="form-row">
                <span id="occupied-info"></span>
                <div id="suggests" style="display: none"> Spróbuj któregoś z tych:  <span id="suggestions"></span> </div>
            </div>

            {% for message in qr.getMessagesFor("url") %}
                <div class="error">{{ message }}</div>
            {% endfor %}
        </fieldset>

        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="fill">Kolor wypełnienia</label>
                <span data-toggle="tooltip" title="Zmiana oryginalnych kolorów może utrudnić aplikacjom odczyt zawartości. Szczególnie gdy między kolorem wypełnienia a tłem nie zostanie zachowany odpowiedni kontrast" class="glyphicon glyphicon-question-sign"></span>

            </div>

            <input type="color" name="fill" title="fill" value="#000000">
        </fieldset>

        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="background">Kolor tła</label>
                <span data-toggle="tooltip" title="Zmiana oryginalnych kolorów może utrudnić aplikacjom odczyt zawartości. Szczególnie gdy między kolorem wypełnienia a tłem nie zostanie zachowany odpowiedni kontrast" class="glyphicon glyphicon-question-sign"></span>

            </div>

            <input type="color" name="background" title="background" value="#ffffff">

        </fieldset>

        <fieldset class="form-fieldset">

            <div class="form-row">
                <label class="form-label" for="file">Grafika</label>
                <span data-toggle="tooltip" title="Grafika która znajdować się będzie w centrum kodu. Przeźroczystość zostanie zastąpiona kolorem czarnym." class="glyphicon glyphicon-question-sign"></span>
                <span>(JPG/PNG)</span>
            </div>

            {{ qr.render("file", {"class": ""}) }}

            {% for message in qr.getMessagesFor("file") %}
                <div class="form-error">{{ message }}</div>
            {% endfor %}
        </fieldset>


        <div style="margin-top: 10px">
            <input type="submit" id="generate" value="Zapisz">
        </div>

    </form>

{% endblock %}
