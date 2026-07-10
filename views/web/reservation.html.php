<!doctype html>
<html lang="fr">
<head>
    <title>Hotel</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-100">
    <header>
    </header>

    <main>
        <div class="container mx-auto pt-5 px-4">

            <?php
                $errors = $viewData['errors'] ?? [];
                $old = $viewData['old'] ?? [];
            ?>

            <?php if(isset($viewData['message'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= $viewData['message'] ?>
                </div>
            <?php endif; ?>

            <h2 class="text-2xl font-bold mb-4">Ajout d'une reservation</h2>

            <form
                action="http://localhost:8080/reservation/index"
                method="POST"
                class="flex flex-wrap gap-4 shadow-lg p-6 mb-5 bg-white rounded-lg"
            >

                <div class="flex-1 min-w-[200px]">
                    <label for="nom" class="block mb-2 font-medium">Nom du client</label>

                    <input
                        type="text"
                        name="nom"
                        id="nom"
                        value="<?php echo isset($errors['nom']) ? '' : $old['nom'] ?? '' ?>"
                        class="w-full px-3 py-2 border rounded-md <?php echo isset($errors['nom']) ? 'border-red-500' : 'border-gray-300'; ?>"
                    />

                    <small class="text-red-500">
                        <?php echo $errors['nom'] ?? ''; ?>
                    </small>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="numero_chambre" class="block mb-2 font-medium">Numero de chambre</label>

                    <input
                        type="text"
                        name="numero_chambre"
                        id="numero_chambre"
                        value="<?php echo isset($errors['numero_chambre']) ? '' : $old['numero_chambre'] ?? ''; ?>"
                        class="w-full px-3 py-2 border rounded-md <?php echo isset($errors['numero_chambre']) ? 'border-red-500' : 'border-gray-300'; ?>"
                    />

                    <small class="text-red-500">
                        <?php echo $errors['numero_chambre'] ?? ''; ?>
                    </small>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="nombre_nuits" class="block mb-2 font-medium">Nombre de nuits</label>
                    <input
                        type="text"
                        name="nombre_nuits"
                        id="nombre_nuits"
                        value="<?php echo isset($errors['nombre_nuits']) ? '' : $old['nombre_nuits'] ?? ''; ?>"
                        class="w-full px-3 py-2 border rounded-md <?php echo isset($errors['nombre_nuits']) ? 'border-red-500' : 'border-gray-300'; ?>"
                    />
                    <small class="text-red-500">
                        <?php echo $errors['nombre_nuits'] ?? ''; ?>
                    </small>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="type_chambre" class="block mb-2 font-medium">type_chambre</label>
                    <select
                        name="type_chambre"
                        id="type_chambre"
                        class="w-full px-3 py-2 border rounded-md <?php echo isset($errors['type_chambre']) ? 'border-red-500' : 'border-gray-300'; ?>"
                    >
                        <option value="STANDARD"
                            <?php echo (($old['type_chambre'] ?? '') === 'STANDARD') ? 'selected' : ''; ?>>
                            STANDARD
                        </option>

                        <option value="CONFORT"
                            <?php echo (($old['type_chambre'] ?? '') === 'CONFORT') ? 'selected' : ''; ?>>
                            CONFORT
                        </option>

                        <option value="SUITE"
                            <?php echo (($old['type_chambre'] ?? '') === 'SUITE') ? 'selected' : ''; ?>>
                            SUITE
                        </option>
                    </select>

                    <small class="text-red-500">
                        <?php echo $errors['type_chambre'] ?? ''; ?>
                    </small>
                </div>
                <div class="flex items-end">
                    <button
                        type="submit"
                        class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800"
                    >
                        Enregistrer
                    </button>
                </div>
            </form>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-4 border-b">
                    <h3 class="text-xl font-semibold">Liste des reservations</h3>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border text-left">ID</th>
                                    <th class="px-4 py-2 border text-left">Nom client</th>
                                    <th class="px-4 py-2 border text-left">N° chambre</th>
                                    <th class="px-4 py-2 border text-left">Nbre nuits</th>
                                    <th class="px-4 py-2 border text-left">Type</th>
                                    <th class="px-4 py-2 border text-left">Statut</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $reservations = $viewData['data'] ?? [];
                                foreach ($reservations as $reservation):
                                ?>
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getId() ?>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getNom_client() ?>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getNumero_chambre() ?>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getNombre_nuits() ?>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getType_chambre() ?>
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <?php echo $reservation->getStatut() ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                <form
                    
                action="http://localhost:8080/reservation/annul"
                method="POST"
                class="w-2/3 shadow-lg p-6 mt-5 bg-white rounded-lg flex flex-wrap gap-4">
                    <h3 class="w-full text-xl font-semibold">
                        Annulation rendez-vous
                    </h3>

                    <div class="flex-1">
                        <label for="id" class="block mb-2 font-medium">
                            Id du chauffeur
                        </label>

                        <input
                            type="text"
                            name="id"
                            id="id"
                            value="<?php echo isset($errors['id']) ? '' : $old['id'] ?? '' ?>"
                            class="w-full px-3 py-2 border rounded-md <?php echo isset($errors['id']) ? 'border-red-500' : 'border-gray-300'; ?>"
                        />
                        

                        <small class="text-red-500">
                            <?php echo $errors['id'] ?? ''; ?>
                        </small>
                    </div>

                    <div class="flex items-end">
                        <button
                            type="submit"
                            name="delete"
                            class="bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800"
                        >
                            Annuler
                        </button>
                
                </div>
                <div class="flex justify-end mt-4">
                    <div class="bg-green-100 p-4 rounded-lg shadow">
                        <h3 class="font-bold">Chiffre d'affaires :</h3>
                        <p class="text-xl font-bold">
                            <?= number_format($viewData['ca'] ?? 0) ?> FCFA
                        </p>
                    </div>
                </div>

                    
                
                </div>
            </form>
            
            </div>
            

        </div>
    </main>
</body>
 <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
</html>
