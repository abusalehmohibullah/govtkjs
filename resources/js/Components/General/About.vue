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
    <h1>Welcome to our school</h1>
    <div class="text-lg">
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
</template>


