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
    <div class="relative p-0">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://th.bing.com/th/id/R.d9b13865b20fcd868bc85359a85ec5a4?rik=joI6nep0Y9Ik8A&riu=http%3a%2f%2fwww.officialgazette.gov.ph%2fimages%2fuploads%2fFeaturedImage_school_150818_1056.jpg&ehk=3GnbUiem4aNIPEBFO97fK%2bnERIAjvFvvkY8B5d7ZFlo%3d&risl=&pid=ImgRaw&r=0"
                        class="d-block w-full aspect-video" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://th.bing.com/th/id/OIP.Lo8ULbsLNs3OlUJsMv4FhgHaDf?pid=ImgDet&rs=1"
                        class="d-block w-full aspect-video" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://th.bing.com/th/id/OIP._6Xvi4vwg4VfZi-keJRw0AHaEK?pid=ImgDet&rs=1"
                        class="d-block w-full aspect-video" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://cdn-ds.com/media/sz_860878/3285/gp-about.jpg"
                        class="d-block w-full aspect-video" alt="...">
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
    </div>
</template>


