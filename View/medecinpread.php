<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Panel Médecin</title>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-4">
                <!-- Logo -->
                <img src="../images/lpfs_logo.png" alt="Logo" class="w-25 h-25 mb-4 mx-auto rounded-full">

            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <div class="bg-gray-800 p-4">
                <h2 class="text-white text-lg font-semibold">Bienvenue, Médecin !</h2>
            </div>

            <!-- Exemple de tableau pour afficher les pré-admissions à venir -->
            <div class="mt-8">
                <h3 class="text-3xl font-semibold mb-4">Voici les pré-admissions à venir ↓</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded mb-4">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-2 px-4">Nom du patient</th>
                                <th class="py-2 px-4">Date d'admission</th>
                                <th class="py-2 px-4">Service</th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <!-- Iterate through your upcoming admissions data and populate the table -->
                            <tr>
            
                                <!-- Add more rows as needed -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
