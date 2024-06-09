<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta-data')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Include Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>{{ config('app.name') }} | @yield('title')</title>
    @stack('style')
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <a href="{{ route('view.dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
               <span>Dashboard</span>
            </a>
            <a href="{{ route('view.post') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span>Posts</span>
             </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <a href="tel:5541251234" class="text-sm text-gray-500 dark:text-white hover:underline">(555)
                    412-1234</a>
                <form onsubmit="logout(this)" action="javascript:;" action_url="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"
                        class="text-sm text-blue-600 dark:text-blue-500 hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')
    @stack('script')
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
</body>

</html>