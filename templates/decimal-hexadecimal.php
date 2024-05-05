<?php
    template('header', array(
        'title' => 'Boite à outils • Décimal - Hexadécimal',
    ));
?>


<section id="homepage" class="homepage ms-5 me-5">
    <div class="container">
        <div class="section-title">
           
            <h2>Convertisseur système décimal positif en binaire </h2>
        </div>

        <div class="row">
           
            <figure class="bg-light rounded">
                <blockquote cite="https://www.huxley.net/bnw/four.html">
                    <p>
                        Le système binaire (du latin binārĭus, « double ») est le système de numération utilisant la base 2. On nomme couramment bit (de l'anglais binary digit, soit « chiffre binaire ») les chiffres de la numération binaire positionnelle. Un bit peut prendre deux valeurs, notées par convention 0 et 1.
                    </p>   <p>
                        Le système binaire est utile pour représenter le fonctionnement de l'électronique numérique utilisée dans les ordinateurs. Il est donc utilisé par les langages de programmation de bas niveau.
                    </p>
                </blockquote>
                <figcaption><cite><a href="https://fr.wikipedia.org/wiki/Syst%C3%A8me_binaire">Wikipedia</a></cite></figcaption>
            </figure>
        </div>

        <!-- Formulaire pour la conversion -->
        <div class="row">
            <fieldset class="col-md-6 mt-3">
                <legend>Convertisseur</legend>
                <form action="" method="post" name="decimal-hexadecimal">
                    <div class="row p-2">
                        <!-- Champ pour le nombre décimal -->
                        <div class="col-12">
                            <label for="decimal" class="form-label">Décimal</label>
                            <div class="input-group">
                                <input id="decimal" name="decimal" type="number" min="0" class="form-control" required>
                            </div>
                        </div>

                        <!-- Champ pour le nombre hexadécimal (résultat) -->
                        <div class="col-12">
                            <label for="hex" class="form-label">Héxadécimal</label>
                            <div class="input-group">
                                <input id="hex" name="hex" type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <!-- Champ pour le nombre binaire (résultat) -->
                        <div class="col-12 mb-2">
                            <label for="binary" class="form-label">Binaire</label>
                            <div class="input-group">
                                <input id="binary" name="binary" type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <!-- Bouton pour soumettre le formulaire de conversion -->
                        <div class="col-auto">
                            <button name="submit" type="submit" class="btn btn-primary">Calculer</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</section>


<script type="text/javascript">
    window.addEventListener('load', () => {
        let forms = document.forms;
        for (form of forms) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                
                // Récupère les données du formulaire
                const formData = new FormData(event.target).entries();

                // Envoie les données du formulaire à l'API via une requête POST
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

                // Récupère la réponse de l'API au format JSON
                const result = await response.json();
                console.log(result);

                // Récupère les noms des champs de résultat
                let inputNameHex = Object.keys(result.data[0])[0];
                let inputNameBin = Object.keys(result.data[1])[0];
                
                // Met à jour les champs de résultat dans le formulaire
                event.target.querySelector(`input[name="hex"]`).value = result.data[0][inputNameHex];
                event.target.querySelector(`input[name="binary"]`).value = result.data[1][inputNameBin];
            });
        }
    });
</script>

<?php 
    template('footer');
?>
