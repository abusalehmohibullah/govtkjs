<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';


defineProps({
    history_title: Object,
    history_content: Object,
});

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="bg-white p-8 relative">
                <div class="text-2xl font-bold">{{ history_title.content }}</div>
                <div class="text-base mt-3" style="white-space: pre-line;">{{ history_content.content }}</div>
            </div>
        </div>
    </GeneralLayout>
</template>

