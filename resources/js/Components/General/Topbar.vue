<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationMark.vue';
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
        <div class="container mx-auto max-w-screen-xl p-2 sm:p-4 flex-col">
            <div class="flex">
                <div class="grid grid-cols-12 sm:flex w-full gap-2 sm:gap-4 content-end">
                    <!-- Logo -->
                    <div class="col-span-2 shrink-0 flex justify-end content-end items-center">
                        <Link :href="route('home')"
                            class="w-16 h-16 sm:w-24 sm:h-24 flex justify-end content-end items-end">
                        <ApplicationLogo class="block" />
                        </Link>
                    </div>

                    <div class="col-span-8 flex flex-col justify-center content-center">
                        <div
                            class="text-center sm:text-left text-lg min-[369px]:text-[19px] min-[383px]:text-xl lg:text-[45px] sm:leading-10 font-medium text-gray-800 font-['Oswald']">
                            Govt. Rajoir Gopalganj K.J.S. Pilot Model Inst<span class="hidden min-[345px]:inline-block">itution</span> & College
                        </div>
                        <div class="hidden sm:block text-sm sm:text-xl sm:leading-10 font-bold mt-2">
                            Established: 1929 | EIIN No: 110791 | School Code: 5553 | Vocational Code: 44005 | College Code:
                            5630
                        </div>
                    </div>
                    <button class="col-span-2 navbar-toggler lg:hidden m-4" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span><i class="fa-solid fa-bars text-xl"></i></span>
                    </button>
                </div>
            </div>
            <div class="sm:hidden text-sm sm:text-xl sm:leading-10 font-bold mt-1 flex flex-col items-center">
                Established: 1929 | EIIN No: 110791
                <div class="text-xs">
                    School Code: 5553 | Voc<span class="hidden min-[371px]:inline-block">ational</span> Code: 44005 | College Code: 5630
                </div>
            </div>
            <!-- <div class="sm:hidden text-sm sm:text-xl sm:leading-10 font-bold mt-2 flex justify-center">
                Established: 1929 | EIIN No: 110791 | 
                <div class="flex flex-col pl-1">
                    <span>School Code: 5553</span>
                    <span>College Code: 5630</span>
                    <span>Vocational Code: 44005</span>
                </div>
            </div> -->
        </div>
    </nav>

    <nav class="navbar bg-[#C6DCE4] border-b border-gray-100 navbar-expand-lg p-0">
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
                                <div class="space-x-8 sm:-my-px sm:flex justify-center items-center">
                                    <Link :href="route('login')" :active="route().current('/')">
                                    <PrimaryButton>Login</PrimaryButton>
                                    </Link>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>


