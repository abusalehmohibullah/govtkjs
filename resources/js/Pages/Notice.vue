<script setup>

import GeneralLayout from '@/Layouts/GeneralLayout.vue';


defineProps({
    notice: Object,
});

</script>

<template>
    <GeneralLayout>
        <div class="container p-5">
            <div class="bg-white p-8 relative">
                <div class="text-2xl font-bold">{{ notice.title }}</div>
                <div class="text-base">{{ notice.content }}</div>
                <iframe :src="notice.attachment" width="100%" height="700px"></iframe>

                <img src="http://127.0.0.1:8000/assets/images/pin.png" alt=""
                        class="h-8 absolute top-1 left-1/2 drop-shadow-xl">
            </div>
        </div>
    </GeneralLayout>
</template>

