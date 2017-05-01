<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ getTitle() }}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        {{ assets.outputCss() }}

    </head>
    <body>

    <div class="page-wrap">

        <div class="row">
            <div class="col-sm-12">
                {% block header %}
                    {{ partial("header") }}
                {% endblock %}
            </div>
        </div>

        <div class="container">



            <div class="row main-row">
                <div class="col-sm-2 left-box">
                    {% block leftBox %}
                    {% endblock %}
                </div>
                <div class="col-sm-8">
                    {% block contentBox %}
                    {% endblock %}
                </div>
                <div class="col-sm-2">
                    {% block rightBox %}
                    {% endblock %}
                </div>
            </div>

        </div>
    </div>

    <div class="site-footer">
        <div class="container">
            <div class="col-sm-12">
                {% block footer %}
                    {{ partial("footer") }}
                {% endblock %}
            </div>
        </div>
    </div>




        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        {{ assets.outputJs() }}
    </body>
</html>
