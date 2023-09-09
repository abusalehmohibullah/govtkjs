<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'sidebar-link d-flex collapsed active'
        : 'sidebar-link d-flex collapsed';
});
</script>

<template>


    <li class="sidebar-item">
        <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link d-flex ">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-layout align-middle">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
            <span class="align-middle">Pages</span>
        </a>

        <Link :href="href" :class="classes">
        <slot />
        </Link>

        <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
            <li class="sidebar-item"><a class="sidebar-link d-flex" href="/pages-settings">Settings</a></li>
            <li class="sidebar-item"><a class="sidebar-link d-flex" href="/pages-clients">Clients <span
                        class="sidebar-badge badge bg-primary">Pro</span></a></li>
        </ul>
    </li>
</template>
