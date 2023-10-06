<template>
    <!-- <div class="grid gap-1 grid-cols-2 grid-rows-2 sm:gap-10 sm:grid-cols-4 sm:grid-rows-1 my-5">
        <div class="card m-0">
            <div class="group card-body bg-white hover:bg-gradient-to-r hover:from-yellow-500 hover:to-red-600 hover:transition-all hover:ease-in hover:duration-300 rounded flex flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 group-hover:text-white text-7xl"></i>
                <h5 class="text-center text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white">Student's Portal</h5>
            </div>
        </div>
        <div class="card m-0">
            <div class="group card-body bg-white hover:bg-gradient-to-r hover:from-sky-500 hover:to-indigo-500 hover:transition-all hover:ease-in hover:duration-300 rounded flex flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 group-hover:text-white text-7xl"></i>
                <h5 class="text-center text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white">Admission Infos</h5>
            </div>
        </div>
        <div class="card m-0">
            <div class="group card-body bg-white hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 hover:transition-all hover:ease-in hover:duration-300 rounded flex flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 group-hover:text-white text-7xl"></i>
                <h5 class="text-center text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white">Check Result</h5>
            </div>
        </div>
        <div class="card m-0">
            <div class="group card-body bg-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 hover:transition-all hover:ease-in hover:duration-300 rounded flex flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 group-hover:text-white text-7xl"></i>
                <h5 class="text-center text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white">Contact with Us</h5>
            </div>
        </div>
    </div> -->

    <div class="grid gap-1 grid-cols-2 grid-rows-2 sm:gap-10 sm:grid-cols-4 sm:grid-rows-1 my-5">
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Student's Portal</h5>
            </div>
            <div
                class="absolute top-0 left-0 w-full card-body bg-gradient-to-r from-yellow-500 to-red-600 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5
                    class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">
                    Student's Portal</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Admission Infos</h5>
            </div>
            <div
                class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-sky-500 hover:to-indigo-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5
                    class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">
                    Admission Infos</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Check Result</h5>
            </div>
            <div
                class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5
                    class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">
                    Check Result</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Contact Us</h5>
            </div>
            <div
                class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i
                    class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5
                    class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">
                    Contact Us</h5>
            </div>
        </div>
    </div>

    <!-- <div class="grid gap-1 grid-cols-2 grid-rows-2 sm:gap-10 sm:grid-cols-4 sm:grid-rows-1 my-5">
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800">Student's Portal</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-gradient-to-r from-yellow-500 to-red-600 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Student's Portal</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800">Admission Infos</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-sky-500 hover:to-indigo-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Admission Infos</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800">Check Result</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Check Result</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800">Contact Us</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Contact Us</h5>
            </div>
        </div>
    </div> -->




    <!-- Notice Board Frame -->
    <!-- <div class="border-8 border-[#7c3511] drop-shadow-md my-5">
        <div class="border-4 border-[#4d2410] p-4 shadow-inner">
            <h1 class="text-2xl font-semibold mb-4">Notice Board</h1>

            <div class="space-y-4">
                <div class="bg-yellow-100 p-4 rounded-md">
                    <h2 class="text-lg font-semibold">Important Event</h2>
                    <p class="text-sm text-gray-600">Join us for an important event on October 15th, 2023.</p>
                </div>

                <div class="bg-blue-100 p-4 rounded-md">
                    <h2 class="text-lg font-semibold">Job Opening</h2>
                    <p class="text-sm text-gray-600">We're hiring! Check out our latest job openings.</p>
                </div>

            </div>
        </div>
    </div> -->


</template>
