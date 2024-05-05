<?php
   
    template('header', array(
        'title' => 'Boite à outils • Convertisseur',
    ));
?>

<!-- Section du convertisseur de devises (Euros) -->
<section id="currency-converter" class="currency-converter mt-2 ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Convertisseur Monétaire</h2>
        </div>
        <!-- Formulaire pour convertir les euros en une autre devise -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de devise</legend>
            <form action="" method="post" name="euros-dollars">
                <div class="row">
                    <!-- Champ pour le montant en euros -->
                    <div class="col">
                        <label for="montant" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input type="number" id="montant" name="montant" class="form-control" required>
                            <div class="input-group-append">
                                <!-- Sélecteur pour choisir la devise source -->
                                <select class="form-select" aria-label="Devise source" id="devisesource" name="devisesource" required>
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

                    <!-- Champ pour afficher le résultat de la conversion -->
                    <div class="col">
                        <label for="devisecible" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="devisecible" name="devisecible" type="text" class="form-control" disabled>
                            <div class="input-group-append">
                                <!-- Sélecteur pour choisir la devise cible -->
                                <select class="form-select" aria-label="Devise cible" id="devisecible" name="devisecible" required>
                                    <?php
                                    // Génère les options de devise à partir des données de l'API
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
            </form>
        </fieldset>
    </div>
</section>

<!-- Section du convertisseur de liquides -->
<section id="liquid-converter" class="liquid-converter ms-5 me-5">
    <div class="container">
        <div class="section-title">
           
            <h2>Convertisseur de Liquide</h2>
        </div>
        <!-- Formulaire pour convertir les millilitres en litres -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de Millilitres en Litres</legend>
            <form action="" method="post" name="mL-L">
                <div class="row">
                    <!-- Champ pour le montant en millilitres -->
                    <div class="col">
                        <label for="mil" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input id="mil" name="mil" type="number" class="form-control" required>
                            <div class="input-group-append">
                                <div class="input-group-text">mL</div>
                            </div>
                        </div>
                    </div>

                    <!-- Texte indiquant la devise cible -->
                    <div class="col-auto align-self-center">
                        <span class="ver">vaut :</span>
                    </div>

                    <!-- Champ pour afficher le résultat de la conversion en litres -->
                    <div class="col">
                        <label for="litre" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="litre" name="litre" type="text" class="form-control" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">L</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                    </div>
                </div>
            </form>
        </fieldset>

        <!-- Formulaire pour convertir les litres en millilitres -->
        <fieldset class="col-12 mt-2 p-3">
            <legend>Convertisseur de Litres en Millilitres</legend>
            <form action="" method="post" name="L-mL">
                <div class="row">
                    <!-- Champ pour le montant en litres -->
                    <div class="col">
                        <label for="litre" class="form-label visually-hidden">Montant à convertir :</label>
                        <div class="input-group">
                            <input id="litre" name="litre" type="number" class="form-control" required>
                            <div class="input-group-append">
                                <div class="input-group-text">L</div>
                            </div>
                        </div>
                    </div>

                    <!-- Texte indiquant la devise cible -->
                    <div class="col-auto align-self-center">
                        <span class="ver">vaut :</span>
                    </div>

                    <!-- Champ pour afficher le résultat de la conversion en millilitres -->
                    <div class="col">
                        <label for="mil" class="form-label visually-hidden">Résultat</label>
                        <div class="input-group">
                            <input id="mil" name="mil" type="text" class="form-control" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">mL</div>
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
</section>

<!-- Script JavaScript pour gérer la soumission du formulaire via AJAX -->
<script type="text/javascript">
    window.addEventListener('load', () => {
        let forms = document.forms;
        for (form of forms) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                
                // Récupération des données du formulaire
                const formData = new FormData(event.target).entries();

                // Envoi des données du formulaire à l'API via une requête POST
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

                // Récupération des résultats de la conversion depuis la réponse de l'API
                const result = await response.json();
                
                // Mise à jour des champs de formulaire avec les résultats de la conversion
                let inputName = Object.keys(result.data)[0];
                if (event.target.name === 'euros-dollars') {
                    event.target.querySelector(`input[name="devisecible"]`).value = result.data[inputName];
                } else if (event.target.name === 'mL-L') {
                    event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
                }
            });
        }
    });
</script>

<?php template('footer');
