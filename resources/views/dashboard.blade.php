<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Include Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>{{ config('app.name') }} | Dashboard</title>
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
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
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-4">Welcome to the Dashboard</h1>
        <div id="userInfo" class="text-lg"></div>
    </div>
    <script>
        
        const token = localStorage.getItem('token');

        axios.get('/api/user', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                $('#userInfo').html('Welcome '+response.data.name)
            })
            .catch(error => {
                console.error(error);
            });



        function logout(form) {
            let url = $(form).attr('action_url');
            let formData = $(form).serialize();
            const token = localStorage.getItem('token');
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
                success: function(response) {
                    if (response.message == 'Successfully logged out') {
                        window.location.href = '/';
                    } else {
                        alert('Logout failed');
                    }
                }
            });
        }
    </script>
</body>

</html>
