<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contactez-nous - Agence de marketing digital - Numev augment votre visibilité</title>
    <link rel="icon" href="favicon.jpeg">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body x-data="{ page: 'blog-single', 'darkMode': true, 'stickyMenu': false, 'navigationOpen': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'b eh': darkMode === true }">
    <!-- ===== Header Start ===== -->
    

    <!-- ===== Header End ===== -->

    <main>
        <!-- ===== About Start ===== -->
        <section class="lg:mt-12 mt-20 justify-start">
            <div class="animate_top   rounded-md shadow-solid-13 bg-white dark:bg-blacksection dark:border-strokedark p-7.5 md:p-10">
              
                <div class="tc wf gg qq">
                    <!-- About Images -->
                    <div class="animate_left jn/2">
    <h2 class="fk vj zp pr text-3xl kk wm qb ml-6 lg:ml-0">Vous avez reçu un message!</h2>
    <p>De : {{ $data['name'] }}</p>
    <p>Email : {{ $data['email'] }}</p>
    <p>Message : {{ $data['message'] }}</p>
</div>

                    <!-- About Content -->
                    
                </div>
            </div>
        </section>
        <!-- ===== About End ===== -->


    </main>
   

    <!-- ====== Back To Top End ===== -->
    <script defer src="js/bundle.js"></script>
</body>

</html>
