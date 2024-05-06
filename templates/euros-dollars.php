<?php

template('header', array(
    'title' => 'Boite à outils • Convertisseur',
));
?>

<!-- ======= Currency Converter Section ======= -->
<section id="currency-converter" class="currency-converter mt-2 ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur Monétaire</h2>
        </div>
        <!-- Formulaire de conversion de devises -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de devise</legend>
            <form action="" method="post" name="euros-dollars">
                <div class="row">
                    <!-- Champ pour entrer le montant à convertir -->
                    <div class="col">
                        <label for="montant" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input type="number" id="montant" name="montant" class="form-control" required>
                            <!-- Sélection de la devise source -->
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

                    <!-- Indicateur de conversion -->
                    <div class="col-auto align-self-center">
                        <span class="ver">vaut actuellement:</span>
                    </div>

                    <!-- Champ pour afficher le résultat de la conversion -->
                    <div class="col">
                        <label for="devisecible" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="devisecible" name="devisecible" type="text" class="form-control " disabled>
                            <!-- Sélection de la devise cible -->
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

                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="col-auto">
                        <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</section><!-- End Currency Converter Section -->

<!-- ======= Liquid Converter Section ======= -->
<section id="liquid-converter" class="currency-converter ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur de Liquide</h2>
        </div>
        <!-- Formulaire de conversion de liquide -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de Millilitres en Litres</legend>
            <form action="" method="post" name="mL-L">
                <div class="row">
                    <!-- Champ pour entrer le montant à convertir -->
                    <div class="col">
                        <label for="mil" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input id="mil" name="mil" type="number" class="form-control" required>
                            <!-- Indicateur de l'unité de mesure -->
                            <div class="input-group-append">
                                <div class="input-group-text">mL</div>
                            </div>
                        </div>
                    </div>

                    <!-- Indicateur de conversion -->
                    <div class="col-auto align-self-center">
                        <span class="ver">vaut :</span>
                    </div>

                    <!-- Champ pour afficher le résultat de la conversion -->
                    <div class="col">
                        <label for="litre" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="litre" name="litre" type="text" class="form-control" disabled>
                            <!-- Indicateur de l'unité de mesure -->
                            <div class="input-group-append">
                                <div class="input-group-text">L</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="col-auto">
                        <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                    </div>
                </div>
            </form>
        </fieldset>

        <!-- Formulaire de conversion inverse de liquide -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de Litres en Millilitres</legend>
            <form action="" method="post" name="mL-L">
                <div class="row">
                    <!-- Champ pour entrer le montant à convertir -->
                    <div class="col">
                        <label for="litre" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input id="litre" name="litre" type="number" class="form-control" required>
                            <!-- Indicateur de l'unité de mesure -->
                            <div class="input-group-append">
                                <div class="input-group-text">L</div>
                            </div>
                        </div>
                    </div>

                    <!-- Indicateur de conversion -->
                    <div class="col-auto align-self-center">
                        <span class="ver">vaut :</span>
                    </div>

                    <!-- Champ pour afficher le résultat de la conversion -->
                    <div class="col">
                        <label for="mil" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="mil" name="mil" type="text" class="form-control" disabled>
                            <!-- Indicateur de l'unité de mesure -->
                            <div class="input-group-append">
                                <div class="input-group-text">mL</div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton pour soumettre le formulaire -->
                    <div class="col-auto">
                        <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</section><!-- End Liquid Converter Section -->

<!-- Script JavaScript pour la gestion des soumissions de formulaire -->
<script type="text/javascript">
    window.addEventListener('load', () => {
        let forms = document.forms;
        for (form of forms) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const formData = new FormData(event.target).entries();

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

                // Mettre à jour le champ de formulaire correct en fonction du nom du formulaire
                if (event.target.name === 'euros-dollars') {
                    event.target.querySelector(`input[name="devisecible"]`).value = result.data[inputName];
                } else if (event.target.name === 'mL-L') {
                    event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
                }
            });
        }
    });
</script>

<?php

template('footer');
?>