<?php
template('header', array(
    'title' => 'Boite à outils • Accueil',
));

$messages = [];

// Traitement du formulaire de contact lorsqu'il est soumis
if (!empty($_POST)) {
    $submited_items = array(
        'name' => htmlspecialchars($_POST['name']),
        'email' => htmlspecialchars($_POST['email']),
        'subject' => htmlspecialchars($_POST['subject']),
        'message' => htmlspecialchars($_POST['message'])
    );

    // Validation des données du formulaire
    $validated_items = validate($submited_items, array(
        'name' => array(
            'label' => 'Name',
            'required' => true,
            'sanitize' => 'string',
            'min' => 2,
            'regexp' => '/^[a-zA-Z0-9]+$/'
        ),
        'email' => array(
            'label' => 'Email',
            'required' => true,
            'sanitize' => 'email',
        ),
        'subject' => array(
            'label' => 'Subject',
            'required' => true,
            'sanitize' => 'string',
        ),
        'message' => array(
            'label' => 'Message',
            'required' => true,
            'sanitize' => 'string',
        )
    ));

    $result = check_validation($validated_items);

    // Si la validation a échoué, afficher les messages d'erreur
    if (!is_passed($result)) {
        $messages = $result;
    } else {
        // Si la validation réussit, insérer les données dans la base de données et afficher un message de succès
        if(insert('admin_messages', $result)) {
            $messages['success'][] = 'Message envoyé !';
        }
    }
}
?>

<!-- Section La boite à outils -->
<section id="homepage" class="homepage ms-5 me-5">
    <div class="container">
        <div class="section-title">
            <h2>La boite à outils </h2>
            <p>La boite à outils est un site accessible 24h/24 et 7j/7 qui vous permet de réaliser un bon nombre de calculs ou transformations nécessaires au quotidien</p>
            <p>Transformer 1/4 de litre en millilitres ou convertir des euros en dollars n'a jamais été aussi simple !</p>
        </div>
        <div class="row">
            <div class="col-lg-12 pt-4 pt-lg-0 content">
                <div class="d-flex justify-content-center">
                    <div id="loader" class="spinner-border" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Formulaire de contact -->
                <form id="contact-form" name="contact-form" method="POST" onsubmit="showLoader()">
                    <?php getAlert($messages); ?>
                    <h3>Il vous manque une fonctionnalité ?</h3>
                    <p class="fst-italic">
                        Écrivez-nous grâce au formulaire de contact et nous vous répondrons dans les plus brefs délais.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Votre nom</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Votre email (pour vous répondre)</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="subject" class="form-label">Objet</label>
                                <input type="text" id="subject" name="subject" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre demande</label>
                                <textarea id="message" name="message" rows="5" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    J'accepte que mes données soient utilisées dans le cadre de ma demande de fonctionnalité
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid gap-2">
                                <!-- Bouton d'envoi du formulaire -->
                                <input type="submit" name="submit-register" value="Envoyé" class="btn  btn-block btn-primary">
                                <?php 
                                    // Traitement de l'envoi du formulaire de contact par email
                                    if (isset($_POST['submit-register'])) {
                                        $to = "frederic.vinet2003@gmail.com";
                                        $subject = htmlspecialchars_decode($result['subject']);
                                        $message = htmlspecialchars_decode($result['message']);

                                        mail($to, $subject, $message);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Script JavaScript pour afficher le loader -->
<script>
    function showLoader() {
        document.getElementById('contact-form').style.display = 'none';
        // Afficher le loader
        document.getElementById('loader').style.display = 'block';
     
        submitForm();
    }

    function submitForm() {
        // Soumettre le formulaire après un court délai (simulé ici par setTimeout)
        setTimeout(function() {
            document.getElementById('contact-form').submit();
        }, 1000); 
    }

    function hideLoader() {
       
        document.getElementById('loader').style.display = 'none';
    }
</script>

<?php template('footer');
