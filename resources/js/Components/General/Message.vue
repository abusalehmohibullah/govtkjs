<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    infos: Object,
});

const adjustTextContainerHeight = (imageRef, textRef) => {
    const imageHeight = imageRef.clientHeight;
    textRef.style.height = `${imageHeight}px`;
};
</script>
<template>
    <div>
        <div class="sm:flex mt-6 bg-white">
            <div class="img-container sm:w-1/3">
                <img ref="image1" src="https://th.bing.com/th/id/OIP.JMLFs6GMSEJQNZ64p1D4BQHaE8?pid=ImgDet&rs=1"
                    class="card-img-top" alt="..." @load="adjustTextContainerHeight($refs.image1, $refs.text1)" />
            </div>
            <div class="sm:w-2/3 p-5 overflow-hidden relative" ref="text1">
                <span class="text-4xl sm:text-6xl font-semibold text-primary mr-2 float-left"><i class="bi bi-quote"></i></span>
                <div class="text-2xl font-bold">{{ infos.message_1_title }}</div>
                <div class="text-container text-base mt-2" style="white-space: pre-line;">{{ infos.message_1_content }}
                    <div
                        class="absolute bottom-0 right-0 w-full flex justify-end bg-gradient-to-b from-transparent to-white pr-5 pb-4">
                        <Link :href="route('admin.notices.create')" class="mt-10">
                        <PrimaryButton>
                            Read More
                        </PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="infos.message_2_content !== null" class="sm:flex mt-6 bg-white">
            <div class="sm:w-1/3">
                <img ref="image2" src="https://th.bing.com/th/id/OIP.QRIqmXSob48-wxy4VLuDaAHaHG?pid=ImgDet&rs=1"
                    class="card-img-top" alt="..." @load="adjustTextContainerHeight($refs.image2, $refs.text2)" />
            </div>
            <div class="sm:w-2/3 p-5 sm:order-first overflow-hidden relative" ref="text2">
                <span class="text-4xl sm:text-6xl font-semibold text-primary mr-2 float-left"><i class="bi bi-quote"></i></span>
                <div class="text-2xl font-bold">{{ infos.message_2_title }}</div>
                <div class="text-container text-base mt-2" style="white-space: pre-line;">{{ infos.message_2_content }}
                    <div
                        class="absolute bottom-0 right-0 w-full flex justify-end bg-gradient-to-b from-transparent to-white pr-5 pb-4">
                        <Link :href="route('admin.notices.create')" class="mt-10">
                        <PrimaryButton>
                            Read More
                        </PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

  