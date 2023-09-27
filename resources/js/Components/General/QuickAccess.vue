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
                <i class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Student's Portal</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-gradient-to-r from-yellow-500 to-red-600 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-person text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Student's Portal</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Admission Infos</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-sky-500 hover:to-indigo-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-backpack3 text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Admission Infos</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Check Result</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-card-checklist text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Check Result</h5>
            </div>
        </div>
        <div class="card m-0 group">
            <div class="card-body bg-white rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800">Contact Us</h5>
            </div>
            <div class="absolute top-0 left-0 w-full card-body bg-white hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 opacity-[0.0001] group-hover:opacity-100 transition-all duration-300 rounded flex flex-row sm:flex-col justify-center items-center gap-4 shadow-sm">
                <i class="bi bi-send text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500 group-hover:text-white transition-all duration-300 text-7xl"></i>
                <h5 class="text-center text-lg sm:text-2xl text-transparent bg-clip-text bg-gray-800 group-hover:text-white transition-all duration-300">Contact Us</h5>
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


</template>