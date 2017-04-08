<div>
    {{ partial("menu/codeSelect") }}
</div>

<div>
    <form id="static-qr-form" method="post" enctype="multipart/form-data">
        <fieldset>
            <label for="name">Nazwa:</label>
            {{ qr.render("text", {"class": "", "placeholder": ""}) }}
            {% for message in qr.getMessagesFor("text") %}
                <div class="error">{{ message }}</div>
            {% endfor %}
        </fieldset>

        <fieldset>
            <label for="target">Cel:</label>
            {{ qr.render("target", {"class": "", "placeholder": ""}) }}
            <span data-toggle="tooltip" title="Pomoc" class="glyphicon glyphicon-question-sign"></span>
            {% for message in qr.getMessagesFor("target") %}
                <div class="error">{{ message }}</div>
            {% endfor %}
        </fieldset>

        <fieldset>
            <div><label for="url">Widoczny addres:</label></div> http://qr-get.in/to/
            {{ qr.render("url", {"class": "", "placeholder": "  "}) }}
            {{ qr.render("firstTry", {"value": ""}) }}
            <input type="button" id="check-occupied" value="Sprawdź dostępność">
            <span id="occupied-info"></span>
                <div id="suggests" style="display: none"> Spróbuj któregoś z tych:  <span id="suggestions"></span> </div>
            {% for message in qr.getMessagesFor("url") %}
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

        <fieldset>
            <label for="file">Grafika:</label>
            {{ qr.render("file", {"class": ""}) }}
            {% for message in qr.getMessagesFor("file") %}
                <div class="error">{{ message }}</div>
            {% endfor %}
        </fieldset>


        <div style="margin-top: 10px">
            <input type="submit" id="generate" value="Zapisz">
        </div>

    </form>
</div>
