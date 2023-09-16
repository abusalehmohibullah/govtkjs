<script setup>
import { Link } from '@inertiajs/vue3';

import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    paginationData: Array,
});
</script>

<template>
    <div v-for="link in paginationData">
        <Link v-if="link.url" :href="link.url">
        <PrimaryButton v-if="link.active" v-html="link.label" />
        <SecondaryButton v-else class="text-slate-600" v-html="link.label" />
        </Link>
        <SecondaryButton v-else v-html="link.label" class="opacity-50" />
    </div>
</template>


    <!-- <template v-for="link in notices.links">
        <template v-if="link.url">
            <Link :href="link.url">
            <template v-if="link.active">
                <PrimaryButton v-html="link.label"/>
            </template>
            <template v-else>
                <SecondaryButton class="text-slate-600" v-html="link.label"/>
            </template>
            </Link>
        </template>
        <template v-else>
            <SecondaryButton v-html="link.label" class="opacity-50"/>
        </template>
    </template> -->
