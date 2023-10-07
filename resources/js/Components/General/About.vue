<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import { ref, watchEffect } from 'vue';
import { usePage } from '@inertiajs/vue3';


const page = usePage();
const show = ref(true);
const style = ref('success');
const message = ref('');

watchEffect(async () => {
    style.value = page.props.jetstream.flash?.bannerStyle || 'success';
    message.value = page.props.jetstream.flash?.banner || '';
    show.value = true;
});

defineProps({
    infos: Object,
});
</script>
<template>
    <div class="bg-white p-4 rounded">
        <h1>{{ infos.history_title }}</h1>

        <div class="text-container text-base" style="white-space: pre-line;">
            {{ infos.history_content }}
        </div>
    </div>
</template>


