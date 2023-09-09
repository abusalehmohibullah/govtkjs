<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationMark.vue';
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;
});


// const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>


<template>
    <nav class="bg-white border-b border-gray-100">
        <div class="container mx-auto max-w-screen-xl p-4 flex">
            <div class="flex w-full gap-4 content-center">
                <!-- Logo -->
                <div class="shrink-0 flex justify-center content-center items-center">
                        <Link :href="route('dashboard')" class="w-24 h-24">
                        <ApplicationLogo class="block" />
                        </Link>
                </div>

                <div class="flex flex-col justify-center content-center">
                    <div class="text-[42px] font-bold text-gray-700">
                        Govt. Rajoir Gopalganj K.J.S. Pilot Institution & College
                    </div>
                    <div class="text-xl font-bold">
                        Established: 1929 | EIIN No: 110791 | School Code: 5553 | College Code: 5630
                    </div>
                </div>
            </div>
            <button class="navbar-toggler lg:hidden" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span><i class="fa-solid fa-bars text-xl"></i></span>
            </button>
        </div>
    </nav>

    <nav class="navbar bg-sky-200 border-b border-gray-100 navbar-expand-lg p-0">
        <div class="container mx-auto max-w-screen-xl">

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex flex-col lg:flex-row gap-2">

                                <!-- Navigation Links -->
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Dashboard
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        About Us
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Admission
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Students
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Teachers
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Managing Committe
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Album
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Scouting
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Exams
                                    </NavLink>
                                </div>
                                <div class="space-x-8 sm:-my-px sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Contact
                                    </NavLink>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>


