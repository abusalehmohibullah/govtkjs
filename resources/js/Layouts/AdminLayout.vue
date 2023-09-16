<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Sidebar from '@/Components/Shared/Sidebar.vue';
import Topbar from '@/Components/Shared/Topbar.vue';
import Footer from '@/Components/Shared/Footer.vue';


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
    <Banner />
    <div>

        <Head :title="title" />


        <div class="bg-gray-100">

            <div class="wrapper">
                <nav id="sidebar" class="sidebar js-sidebar" :class="{ 'collapsed': isCollapsed }">
                    <Sidebar />
                </nav>

                <div class="main">
                    <nav class="navbar navbar-expand navbar-light navbar-bg">
                        <button class="ml-4 p-3" @click="toggleSidebar">

                            <div class="flex justify-center items-center">
                                <i class="hamburger align-self-center"></i>
                            </div>
                            
                        </button>
                        <Topbar />
                    </nav>



                    <!-- Page Content -->
                    <main class="content">
                        <!-- <slot name="header" /> -->
                        <slot />
                    </main>

                    <Footer />

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isCollapsed: false, // Initially, the sidebar is not collapsed
        };
    },
    methods: {
        toggleSidebar() {
            this.isCollapsed = !this.isCollapsed;
        },
    },
};
</script>