<?php
template('header', array(
    'title' => 'Boite à outils • Devise',
));
?>

<!-- ======= Currency Converter Section ======= -->
<section id="currency-converter" class="currency-converter mt-2 ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur</h2>
        </div>

        <!-- <div class="row">

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
    </div> -->
        <fieldset class="col-12 mt-4 p-3">
            <legend>convertisseur de devise</legend>
            <form action="" method="post" name="euros-dollars">
                <div class="row">
                    <div class="col">
                        <label for="montant" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input type="number" id="montant" name="montant" class="form-control" required>
                            <div class="input-group-append">

                                <select class="form-select" aria-label="Default select example" id="devisesource" name="devisesource" required>
                                    <?php
                                    // URL de l'API pour obtenir les taux de change
                                    $url = 'https://open.er-api.com/v6/latest';

                                    // Récupération des données JSON de l'API
                                    $data = file_get_contents($url);
                                    $data = json_decode($data, true);

                                    // Récupération des devises disponibles
                                    $devises = array_keys($data['rates']);

                                    // Génération des options de devise
                                    foreach ($devises as $devise) {
                                        echo "<option value=\"{$devise}\">{$devise}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-auto align-self-center">
                        <span class="ver">vaut actuellement:</span>
                    </div>

                    <div class="col">
                        <label for="devisecible" class="form-label visually-hidden">resultat</label>
                        <div class="input-group">
                            <input id="devisecible" name="devisecible" type="text" class="form-control " disabled>
                            <div class="input-group-append">
                                <select class="form-select" aria-label="Default select example" id="devisecible" name="devisecible" required>
                                    <?php
                                    // Génération des options de devise (mêmes devises que pour la source)
                                    foreach ($devises as $devise) {
                                        echo "<option value=\"{$devise}\">{$devise}</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                        </div>

                    </div>
                </div>
            </form>
        </fieldset>

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

                event.target.querySelector(`input[name="devisecible"]`).value = result.data[inputName];
            });
        }
    });
</script>

<?php template('footer');
