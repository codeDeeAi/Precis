<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precis</title>
    <link rel="stylesheet" href="/css/tailwind.css">
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold text-gray-800">Precis - PHP MVC Framework </h1>
            <nav class="text-gray-600">
                <a class="mx-4 hover:text-gray-800" href="#about">About</a>
                <a class="mx-4 hover:text-gray-800" href="#features">Features</a>
                <a class="mx-4 hover:text-gray-800" href="https://github.com/codeDeeAi/Precis#documentation">Documentation</a>
                <a class="mx-4 hover:text-gray-800" href="https://www.adeolabada.com/">Contact Us</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-8">
        <section id="about" class="mt-6">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <div class="max-w-xl sm:mx-auto lg:max-w-2xl">
                    <div class="flex flex-col mb-16 sm:text-center sm:mb-0">
                        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
                            <h2
                                class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                                Introducing the Precis Framework
                            </h2>
                            <p class="text-base text-gray-700 md:text-lg">
                                Précis is a custom php framework created to undestand how other php frameworks
                                like Laravel, Symphony etc works under the hood.
                            </p>
                        </div>
                        <div>
                            <a href="https://github.com/codeDeeAi/Precis"
                                class=" bg-blue-700 hover:bg-blue-800 inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
                                Get started
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="mt-6">
            <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
                <h5 class="mb-8 text-4xl font-extrabold leading-none md:pl-2">
                    Features
                </h5>
                <div class="w-full">
                    <ul class="space-y-3 grid grid-cols-3 gap-5">
                        @foreach ($features as $feature)
                            <li class="flex items-start">
                                <span class="mr-1">
                                    <svg class="w-5 h-5 mt-px text-deep-purple-accent-400" stroke="currentColor"
                                        viewBox="0 0 52 52">
                                        <polygon stroke-width="4" stroke-linecap="round" stroke-linejoin="round"
                                            fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                                    </svg>
                                </span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <section id="documentation" class="mt-6">
            <div class="flex justify-center">
                <a href="https://github.com/codeDeeAi/Precis"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Github</a>
                <a href="https://github.com/codeDeeAi/Precis#documentation"
                    class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Documentation</a>
            </div>
        </section>
    </main>
    <footer class="bg-gray-800 text-white py-4 mt-6">
        <div class="container mx-auto flex justify-between items-center">
            <p>© @php echo date("Y"); @endphp Precis All rights reserved.</p>
            <p>Created by <a href="https://www.adeolabada.com/" class="font-bold hover:text-gray-400">Adeola Bada</a>
            </p>
        </div>
    </footer>
</body>

</html>
