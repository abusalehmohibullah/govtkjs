<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';


defineProps({
    message_1_title: Object,
    message_1_content: Object,
});

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="bg-white p-8 relative">
                <div class="text-2xl font-bold">{{ message_1_title.content }}</div>
                <div class="text-base mt-3" style="white-space: pre-line;">{{ message_1_content.content }}</div>
            </div>
        </div>
    </GeneralLayout>
</template>

