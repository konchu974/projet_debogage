<?php
template('header', array(
    'title' => 'Boite à outils • Devise',
));
?>

<!-- ======= Currency Converter Section ======= -->
<section id="currency-converter" class="currency-converter mt-2 ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur de devise</h2>
        </div>

        <div class="row">

            <fieldset class="col-12 mt-4 p-3">
                <legend>Euro vers dollar américain</legend>
                <form action="" method="post" name="euros-dollars">
                    <div class="row">
                        <div class="col">
                            <label for="EUR" class="form-label visually-hidden">Euros</label>
                            <div class="input-group">
                                <input id="EUR" name="EUR" type="text" class="form-control" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">€</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto align-self-center">
                            <span class="ver">vaut actuellement</span>
                        </div>

                        <div class="col">
                            <label for="USD" class="form-label visually-hidden">Dollars</label>
                            <div class="input-group">
                                <input id="USD" name="USD" type="text" class="form-control" disabled>
                                <div class="input-group-append">
                                    <div class="input-group-text">$</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                        </div>
                    </div>
                </form>
            </fieldset>

            <fieldset class="col-12 mt-4 p-3">
                <legend>Dollar américain vers euro</legend>
                <form action="" method="post" name="euros-dollars">
                    <div class="row">
                        <div class="col">
                            <label for="USD" class="form-label visually-hidden">Dollars</label>
                            <div class="input-group">
                                <input id="USD" name="USD" type="text" class="form-control" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">$</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto align-self-center">
                            <span class="ver">vaut actuellement</span>
                        </div>

                        <div class="col">
                            <label for="EUR" class="form-label visually-hidden">Euros</label>
                            <div class="input-group">
                                <input id="EUR" name="EUR" type="text" class="form-control" disabled>
                                <div class="input-group-append">
                                    <div class="input-group-text">€</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</section><!-- End Currency Converter Section -->



    <script type="text/javascript">
    window.addEventListener('load', () => {
        let forms = document.forms;

        for (form of forms) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const formData = new FormData(event.target).entries()

                const response = await fetch('/api/post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(
                        Object.assign(Object.fromEntries(formData), {
                            form: event.target.name
                        })
                    )
                });

                const result = await response.json();

                let inputName = Object.keys(result.data)[0];

                event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
            });
        }
    });
    </script>

<?php template('footer');
