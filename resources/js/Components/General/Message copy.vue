<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    infos: Object,
});

const image1 = ref(null);
const image2 = ref(null);
const text1 = ref(null);
const text2 = ref(null);

const image1Height = computed(() => {
    if (image1.value) {
        return image1.value.clientHeight;
    }
    return 'auto'; // Default height if image1 is not available
});

const image2Height = computed(() => {
    if (image2.value) {
        return image2.value.clientHeight;
    }
    return 'auto'; // Default height if image2 is not available
});

// Function to update the height of about based on text1's height
const updatetext1Height = () => {
    if (text1.value) {
        text1.value.style.height = `${image1Height.value}px`;
        text1.value.style.display = `block`;
    }
};
// Function to update the height of about based on text2's height
const updatetext2Height = () => {
    if (text2.value) {
        text2.value.style.height = `${image2Height.value}px`;
        text2.value.style.display = `block`;
    }
};

// Watch for changes to notice's content and update about's height
onMounted(() => {
    updatetext1Height();
    updatetext2Height();
});


// const adjustTextContainerHeight = (imageRef, textRef) => {
//     const imageHeight = imageRef.clientHeight;
//     textRef.style.height = `${imageHeight}px`;
//     textRef.style.display = `block`;
// };
</script>

<template>
    <div>
        <div class="sm:flex mt-6 bg-white rounded overflow-hidden">
            <div ref="image1" class="sm:w-2/5 rounded over">
                <img src="https://th.bing.com/th/id/OIP.JMLFs6GMSEJQNZ64p1D4BQHaE8?pid=ImgDet&rs=1"
                    class="card-img-top" alt="..." />
            </div>
            <div class="sm:w-3/5 p-5 hidden overflow-hidden relative text-justify rounded" ref="text1">
                <div class="text-2xl font-bold">{{ infos.message_1_title }}</div>
                <div>{{ infos.message_1_content }}</div>
                <div class="absolute bottom-0 right-0 w-full flex justify-end bg-gradient-to-b from-transparent to-white pr-5 pb-4">
                    <Link :href="route('admin.notices.create')" class="mt-10">
                    <PrimaryButton>
                        Read More
                    </PrimaryButton>
                    </Link>
                </div>
            </div>
        </div>
        <div v-if="infos.message_2_content !== null" class="sm:flex mt-6 bg-white rounded overflow-hidden">
            <div ref="image2" class="sm:w-2/5 rounded over">
                <img src="https://th.bing.com/th/id/OIP.JMLFs6GMSEJQNZ64p1D4BQHaE8?pid=ImgDet&rs=1"
                    class="card-img-top" alt="..." />
            </div>
            <div class="sm:w-3/5 p-5 hidden overflow-hidden relative text-justify sm:order-first rounded" ref="text2">
                <div class="text-2xl font-bold">{{ infos.message_2_title }}</div>
                <div>{{ infos.message_2_content }}</div>
                <div class="absolute bottom-0 right-0 w-full flex justify-end bg-gradient-to-b from-transparent to-white pr-5 pb-4">
                    <Link :href="route('admin.notices.create')" class="mt-10">
                    <PrimaryButton>
                        Read More
                    </PrimaryButton>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
  