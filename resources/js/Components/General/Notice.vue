<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
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
        <div class="container mx-auto max-w-screen-xl p-4">
            <div class="text-4xl font-bold text-center text-gray-700 uppercase">
                Govt. Rajoir Gopalganj K.J.S. Pilot Institution & College
            </div>
        </div>
    </nav>

    <nav class="navbar bg-sky-200 border-b border-gray-100 navbar-expand-lg p-0">
        <div class="container mx-auto max-w-screen-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">

                                <!-- Navigation Links -->
                                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                    <NavLink :href="route('dashboard')" :active="route().current('/')">
                                        Dashboard
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container relative p-0">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://th.bing.com/th/id/R.edbe374164ba72dc1ee43e17832ea835?rik=Lioc2fSX%2bat1%2fA&pid=ImgRaw&r=0"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://th.bing.com/th/id/R.edbe374164ba72dc1ee43e17832ea835?rik=Lioc2fSX%2bat1%2fA&pid=ImgRaw&r=0"
                        class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://th.bing.com/th/id/R.edbe374164ba72dc1ee43e17832ea835?rik=Lioc2fSX%2bat1%2fA&pid=ImgRaw&r=0"
                        class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="absolute top-0 left-0 h-full ">
            <div class="flex h-full">
                <div class="w-2/3"></div>
                <div
                    class="w-1/3 text-black flex flex-col justify-center h-full p-10" style="<style>
background: rgba(20, 20, 20, 0.1);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(4.5px);
-webkit-backdrop-filter: blur(4.5px);
border: 1px solid rgba(20, 20, 20, 0.12);
</style>"> 
                    <div>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non aliquam incidunt nesciunt sit
                        inventore amet, officia tenetur accusantium quibusdam recusandae voluptas voluptate eveniet ratione
                        nihil cumque nisi dignissimos autem ducimus.
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non aliquam incidunt nesciunt sit
                        inventore amet, officia tenetur accusantium quibusdam recusandae voluptas voluptate eveniet ratione
                        nihil cumque nisi dignissimos autem ducimus.
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non aliquam incidunt nesciunt sit
                        inventore amet, officia tenetur accusantium quibusdam recusandae voluptas voluptate eveniet ratione
                        nihil cumque nisi dignissimos autem ducimus.
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non aliquam incidunt nesciunt sit
                        inventore amet, officia tenetur accusantium quibusdam recusandae voluptas voluptate eveniet ratione
                        nihil cumque nisi dignissimos autem ducimus.
                    </div>
                    <div><button>hgghh</button></div>
                </div>
            </div>
        </div>
    </div>
</template>


