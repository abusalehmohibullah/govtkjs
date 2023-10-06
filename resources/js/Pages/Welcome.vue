<script setup>

import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import ScrollingNotice from '@/Components/General/ScrollingNotice.vue';
import Slider from '@/Components/General/Slider.vue';
import QuickAccess from '@/Components/General/QuickAccess.vue';
import About from '@/Components/General/About.vue';
import Notice from '@/Components/General/Notice.vue';
import NoticeNew from '@/Components/General/NoticeNew.vue';
import Compliance from '@/Components/General/Compliance.vue';
import Message from '@/Components/General/Message.vue';
import AcademicInfo from '@/Components/General/AcademicInfo.vue';
import FAQ from '@/Components/General/FAQ.vue';
import Album from '@/Components/General/Album.vue';
import Contact from '@/Components/General/Contact.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    infos: Object,
    notices: Object,
    sliders: Object,
    faqs: Object,
    scrolls: Object,
});

const notice = ref(null);
const about = ref(null);
const compliance = ref(null);

const noticeHeight = computed(() => {
    if (notice.value) {
        return notice.value.clientHeight;
    }
    return 'auto'; // Default height if notice is not available
});

const complianceHeight = computed(() => {
    if (compliance.value) {
        return compliance.value.clientHeight;
    }
    return 'auto'; // Default height if compliance is not available
});

// Function to update the height of about based on notice's height
const updateDiv2Height = () => {
    if (about.value) {
        about.value.style.height = `${noticeHeight.value - complianceHeight.value}px`;
        about.value.style.display = `block`;
    }
};

// Watch for changes to notice's content and update about's height
onMounted(() => {
    updateDiv2Height();
});

// You can also watch for changes to notice's content if needed
// watch(() => notice.value.innerHTML, () => {
//   updateDiv2Height();
// });

</script>

<template>
    <GeneralLayout>
        <div class="container">
            <ScrollingNotice :scrolls="scrolls" />
            <Slider :sliders="sliders" />
            <QuickAccess />


            <div class="sm:flex gap-5 mb-5">
                <div class="sm:w-2/3">
                    <div ref="about" class="hidden overflow-hidden relative">
                        <About :infos="infos" />
                        <div
                            class="absolute bottom-0 right-0 w-full flex justify-end bg-gradient-to-b from-transparent to-white pr-5 pb-4">
                            <Link :href="route('admin.notices.create')" class="mt-10">
                            <PrimaryButton>
                                Read More
                            </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                    <div ref="compliance">
                        <Compliance />
                    </div>
                </div>
                <div class="sm:w-1/3 mt-4 sm:mt-0">
                    <div ref="notice" class="h-full">
                        <Notice/>
                    </div>
                </div>
            </div>
            <NoticeNew :notices="notices" />
            <FAQ :faqs="faqs" />
            <Message :infos="infos" />

            <AcademicInfo />
            <Album />


            <Contact :infos="infos" />


        </div>



    </GeneralLayout>
</template>



<!-- <script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <inertia-link :href="route('loginOptions')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login
                </inertia-link>
            </template>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

        </div>
    </div>
</template> -->

<!-- <style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style> -->
