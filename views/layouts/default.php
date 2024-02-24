<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'ModaMix' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://unpkg.com/medium-zoom/dist/medium-zoom.min.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/14273d579a.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100">
    <header class="pb-4">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">ModaMix</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="<?= $router->generate('home') ?>">Accueil</a>
                    </div>
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="<?= $router->generate('about') ?>">Qui sommes-nous?</a>
                    </div>
                    <div class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a href="<?php echo $router->generate('logout'); ?>" class="btn btn-danger">Logout</a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container mt-4">
            <?= $content ?>
        </div>
    </main>

    <footer class="border-top footer mt-auto">
        <div class="container py-5">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-4">
                    <a class="navbar-brand text-dark text-uppercase fw-bold" href="#">
                        ModaMix
                    </a>
                </div>
                <div class="col-12 col-md-4 text-md-center">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="modal"
                               data-bs-target="#mentionsLegales">Mentions légales</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-4 text-md-end">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="tooltip"
                               title="LinkedIn">
                                <i class="fab fa-linkedin fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="tooltip"
                               title="Instagram">
                                <i class="fab fa-instagram-square fa-2x"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none text-dark" data-bs-toggle="tooltip" title="Twitter">
                                <i class="fab fa-twitter-square fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mentionsLegales" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mentions Légales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, repellendus perspiciatis error minus voluptas deleniti enim rem iste architecto sed voluptate molestias in fugiat atque temporibus ipsum saepe est dicta?
                            Non sequi illo accusantium repudiandae, dignissimos veritatis at, nulla ab velit omnis accusamus quas error debitis? Aliquid illo repellendus expedita ratione sint laborum maxime deleniti, repudiandae blanditiis voluptate inventore laboriosam!
                            Corporis, nemo eius. Adipisci, recusandae accusamus? Provident voluptate saepe officia, tenetur adipisci commodi tempore pariatur, eligendi harum nam dignissimos sunt sit vel rerum! Aliquam fugiat vitae nobis nemo quis eius?
                            Voluptas vero quo perferendis, eveniet beatae architecto officia, eum doloremque recusandae fuga molestias! Minus sunt expedita, accusantium beatae enim ipsa debitis. Eius labore iste, quaerat culpa quae saepe ipsam facilis.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
                </script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    </footer>
</body>
</html>
