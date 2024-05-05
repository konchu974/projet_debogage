<?php
// Inclusion du fichier de modèle 'header' avec un tableau de paramètres
template('header', array(
    'title' => 'Boite à outils • Règle de trois', // Définition du titre de la page
));
?>


<!-- ======= About Section ======= -->
<section id="homepage" class="homepage mt-2 ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>La règle de trois</h2>
        </div>

        <div class="row">
            <figure class="bg-light rounded p-3">
                <blockquote cite="https://www.huxley.net/bnw/four.html">
                    <p>En mathématiques élémentaires, la règle de trois ou règle de proportionnalité ou produit en croix est une méthode mathématique permettant de déterminer une quatrième proportionnelle. Plus précisément, trois nombres a, b et c étant donnés, la règle de trois permet, à partir de l'égalité des produits en croix, de trouver le nombre d tel que (a, b) soit proportionnel à (c, d).</p>
                </blockquote>
                <figcaption><cite><a href="https://fr.wikipedia.org/wiki/R%C3%A8gle_de_trois">Wikipedia</a></cite></figcaption>
            </figure>
        </div>

        <div class="row">
            <fieldset class="col-12 mt-4">
                <legend>Calculer X</legend>
                <form action="" method="POST" name="regle-de-trois">
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <label for="a" class="form-label visually-hidden">Nombre A</label>
                            <div class="input-group">
                                <input id="a" name="a" type="number" class="form-control" aria-label="Nombre A">
                            </div>
                        </div>

                        <div class="col-md-auto align-self-center">
                            <span class="ver"> ----> </span>
                        </div>
                        <div class="col-md-5 mx-auto">
                            <label for="c" class="form-label visually-hidden">Nombre C</label>
                            <div class="input-group">
                                <input id="c" name="c" type="number" class="form-control" aria-label="Nombre C">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-5 mx-auto">
                            <label for="b" class="form-label visually-hidden">Nombre B</label>
                            <div class="input-group">
                                <input id="b" name="b" type="number" class="form-control" aria-label="Nombre B">
                            </div>
                        </div>

                        <div class="col-md-auto align-self-center">
                            <span class="ver"> ----> </span>
                        </div>
                        <div class="col-md-5 mx-auto">
                            <label for="d" class="form-label visually-hidden">Nombre D</label>
                            <div class="input-group">
                                <input id="d" name="d" type="text" class="form-control" aria-label="Nombre D" disabled value="X">
                            </div>
                        </div>
                    </div>

                        <div class="d-grid gap-2 p-3">
                            <button name="submit" type="submit" class="btn btn-primary btn-block">Calculer</button>
                        </div>
                </form>
            </fieldset>
        </div>
    </div>
</section>


<script type="text/javascript">
    // Attend que la fenêtre soit chargée
    window.addEventListener('load', () => {
        // Sélectionne tous les formulaires de la page
        let forms = document.forms;

        for (form of forms) {
            // Ajoute un écouteur d'événements pour l'événement de soumission du formulaire
            form.addEventListener('submit', async (event) => {
                // Empêche le comportement par défaut du formulaire de se soumettre
                event.preventDefault();

                // Crée un objet FormData contenant les données du formulaire soumis
                const formData = new FormData(event.target).entries()

                // Effectue une requête POST à l'API '/api/post'
                const response = await fetch('/api/post', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json' 
                    },
                    body: JSON.stringify( // Corps de la requête : les données du formulaire au format JSON
                        // Crée un objet JSON contenant les données du formulaire et le nom du formulaire
                        Object.assign(Object.fromEntries(formData), {
                            form: event.target.name 
                        })
                    )
                });

                // Attend la réponse de la requête et la transforme en objet JSON
                const result = await response.json();

                // Récupère le nom du premier champ de saisie de la réponse
                let inputName = Object.keys(result.data)[0];

                // Met à jour la valeur du champ de saisie correspondant dans le formulaire soumis
                event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
            });
        }
    });
</script>


<?php template('footer');
