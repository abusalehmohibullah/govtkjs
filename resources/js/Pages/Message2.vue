<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';


defineProps({
    message_2_title: Object,
    message_2_content: Object,
});

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="bg-white p-8 relative">
                <div class="text-2xl font-bold">{{ message_2_title.content }}</div>
                <div class="text-base mt-3" style="white-space: pre-line;">{{ message_2_content.content }}</div>
            </div>
        </div>
    </GeneralLayout>
</template>

