<?php
template('header', array(
    'title' => 'Boite à outils • Code césar',
));
?>

<!-- ======= CESAR ======= -->
<!-- Section pour le code de César -->
<section id="cesar" class="cesar ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>Coder ou décoder un texte à l'aide du Code César </h2>
        </div>

        <!-- Description du code de César -->
        <div class="row">
            <figure class="bg-light rounded p-3">
                <blockquote cite="https://www.huxley.net/bnw/four.html">
                    <p>
                        Le code César est une méthode de cryptage qui consiste à décaler chaque lettre de l'alphabet d'un certain rang. Ce code est le plus simple et le plus connu de la cryptographie, mais cela reste très amusant à utiliser.
                    </p>

                    <p>
                        Le code César consiste à substituer une lettre par une autre un plus loin dans l'alphabet, c'est-à-dire qu'une lettre est toujours remplacée par la même lettre et que l'on applique le même décalage à toutes les lettres, cela rend très simple le décodage d'un message puisqu'il y a 25 décalages possibles.
                    </p>
                </blockquote>
                <figcaption><cite><a href="https://calculis.net/code-cesar">Calculis.net</a></cite></figcaption>
            </figure>
        </div>

        <!-- Formulaires pour chiffrer et déchiffrer -->
        <div class="row justify-content-around">
            <!-- Formulaire pour chiffrer -->
            <fieldset class="col-5 mt-4 ms-5">
                <legend>Chiffrer</legend>
                <form action="" method="POST" name="cesar">
                    <!-- Champ pour le texte à chiffrer -->
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="clear">Le texte à chiffrer</label>
                            <div class="input-group">
                                <textarea id="clear" name="clear" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>

                        <!-- Champ pour la clé de chiffrement -->
                        <div class="col-12 mt-4">
                            <label for="key">Clé</label>
                            <div class="input-group">
                                <input id="key" name="key" type="number" class="form-control">
                            </div>
                        </div>

                        <!-- Affichage du résultat -->
                        <div class="col-12 mt-4">
                            <label for="result">Résultat</label>
                            <p id="result"></p>
                        </div>
                    </div>

                    <!-- Bouton pour soumettre le formulaire de chiffrement -->
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn-block btn btn-primary">Chiffrer</button>
                        </div>
                    </div>
                </form>
            </fieldset>

            <!-- Formulaire pour déchiffrer -->
            <fieldset class="col-5 mt-4  ms-md-auto me-5">
                <legend>Déchiffrer</legend>
                <form action="" method="POST" name="cesar">
                    <!-- Champ pour le texte à déchiffrer -->
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="result">Le texte à déchiffrer</label>
                            <div class="input-group">
                                <textarea id="result" name="result" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>

                        <!-- Champ pour la clé de déchiffrement -->
                        <div class="col-12 mt-4">
                            <label for="key">Clé</label>
                            <div class="input-group">
                                <input id="key" name="key" type="number" class="form-control" >
                            </div>
                        </div>

                        <!-- Affichage du résultat -->
                        <div class="col-12 mt-4">
                            <label for="clear">Résultat</label>
                            <p id="clear"></p>
                        </div>
                    </div>

                    <!-- Bouton pour soumettre le formulaire de déchiffrement -->
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn-block btn btn-primary">Déchiffrer</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</section>



<!-- Script pour gérer la soumission des formulaires via AJAX -->
<script type="text/javascript">
    window.addEventListener('load', () => {
        let forms = document.forms;

        // Pour chaque formulaire sur la page
        for(form of forms){
            // Ajoute un écouteur d'événement pour la soumission
            form.addEventListener('submit', async (event) => {
                event.preventDefault(); 

                // Récupère les données du formulaire
                const formData = new FormData(event.target).entries()

                // Envoie les données du formulaire à l'API via une requête POST
                const response = await fetch('/api/post', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(
                        Object.assign(Object.fromEntries(formData), {form: event.target.name})
                    )
                });

                // Récupère la réponse de l'API au format JSON
                const result = await response.json();

                // Affiche le résultat renvoyé par l'API dans le formulaire
                let inputName = Object.keys(result.data)[0];
                event.target.querySelector(`#${inputName}`).innerHTML= result.data[inputName];

            })
        }
    });
</script>

<?php 
template('footer');
?>
