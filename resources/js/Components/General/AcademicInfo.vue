<script setup>
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>
<template>
    <!-- <div class="grid gap-1 grid-cols-2 grid-rows-2 sm:gap-4 sm:grid-cols-4 sm:grid-rows-1 mt-5">
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7">Class Routine</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-red-600">
                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7">Curriculum</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-transparent bg-clip-text bg-gradient-to-r from-sky-500 to-indigo-500">
                    <i class="bi bi-list-columns-reverse"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7">Sections Info</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                    <i class="bi bi-grid-3x3"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7">Students Info</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>

    </div> -->


    <div class="grid gap-1 grid-cols-2 grid-rows-2 sm:gap-4 sm:grid-cols-4 sm:grid-rows-1 mt-5">
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7 text-transparent bg-clip-text bg-gradient-to-l from-yellow-600 to-red-600">Class Routine</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-gray-800/30">
                    <i class="bi bi-layout-text-sidebar-reverse"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7 text-transparent bg-clip-text bg-gradient-to-l from-sky-500 to-indigo-500">Curriculum</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-gray-800/30">
                    <i class="bi bi-list-columns-reverse"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7 text-transparent bg-clip-text bg-gradient-to-l from-green-500 to-blue-500">Sections Info</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-gray-800/30">
                    <i class="bi bi-grid-3x3"></i>
                </div>
            </div>
        </div>
        <div class="card m-0">
            <div class="card-body bg-[#C6DCE4] text-gray-700 rounded">
                <h5 class="text-xl sm:text-3xl mb-7 text-transparent bg-clip-text bg-gradient-to-l from-purple-500 to-pink-500">Students Info</h5>
                <Link :href="route('admin.notices.create')" class="mt-10">
                <PrimaryButton>
                    View
                </PrimaryButton>
                </Link>
                <div class="absolute right-2 top-1/2 text-5xl sm:text-6xl text-gray-800/30">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>

    </div>
</template>