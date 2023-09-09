<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'sidebar-item active'
        : 'sidebar-item';
});
</script>

<template>
    <li :class="classes">
        <Link class="sidebar-link d-flex" :href="href">
        <slot />
        </Link>
    </li>
</template>
