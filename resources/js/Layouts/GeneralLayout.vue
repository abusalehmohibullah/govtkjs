<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

import Topbar from '@/Components/General/Topbar.vue';
import Footer from '@/Components/General/Footer.vue';


defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

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
            <div class="wrapper">

           
                <div class="main">

                    <Topbar/>
                    <!-- Page Heading -->
                    
                    


                    <!-- Page Content -->

                    <main class="content">

                        <slot />
                    </main>
                    
                    
                    <Footer/>

                </div>
            </div>
</template>

