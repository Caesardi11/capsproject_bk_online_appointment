<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Online Appointment System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2053&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-right md:object-center">
    <div class="absolute inset-0 bg-black/65">
        <div class="ml-32 my-64">
            <h1 class="text-5xl font-bold tracking-tight text-white">Hospital Online Appointment System (HOAS)</h1>
            <p class="mt-8 mb-6 text-lg text-gray-300">Selamat datang, silahkan login dahulu untuk mengakses fitur
                lainnya</p>
            <a href="{{ route('login') }}"
                class="rounded-xl bg-indigo-600 px-7 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</a>
        </div>
    </div>
</body>

</html>
