<form id="login-form" method="post">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-centered table-bordered ">
                <div class="wrath-content-box"> <span>Zaloguj się</span> </div>
                <div class="wrath-content-box">
                    <div class="form-group">
                        {{ loginForm.render("email", {"class": "form-control", "placeholder": "Adres e-mail"}) }}
                        {% for message in loginForm.getMessagesFor("email") %}
                            <div class="error">{{ message }}</div>
                        {% endfor %}
                    </div>
                    <div class="form-group">
                        {{ loginForm.render("password", {"class": "form-control", "placeholder": "Hasło"}) }}
                        {% for message in loginForm.getMessagesFor("password") %}
                            <div class="error">{{ message }}</div>
                        {% endfor %}
                    </div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-success btn-sm form-control" value="Login" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</form>
