<script setup>
import GeneralLayout from '@/Layouts/GeneralLayout.vue';
import Slider from '@/Components/General/Slider.vue';
import About from '@/Components/General/About.vue';
</script>

<template>
    <GeneralLayout>

        <Slider />

        <div class="container flex">
            <div class="w-2/3">
                <About />

                <div class="container flex gap-5">
                    <div class="w-1/2">
                        <div class="card m-0">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="card m-0">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-1/3">
                <div class="notice-box shadow-sm bg-white px-3 py-2 h-100">
                    <div class="d-flex jusify-content-center align-items-center">
                        <h3 class="alert-heading deep-color mt-2 large-text">MDCH News</h3>
                        <div class="ms-auto"><a href="https://mdch.edu.bd/education/news">See All</a></div>
                    </div>
                    <hr>
                    <div class="notices">
                        <ul>
                                                        <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown" style="animation-delay: 0s;">
                                <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti" class="hover-deep text-reset text-decoration-none text-nowrap">
                                    <div class="text-truncate mini-text">
                                        ২০২২-২০২৩ শিক্ষাবর্ষে ডেন্টাল কলেজ ও মেডিকেল কলেজ ডেন্টাল ইউনিটসমূহে বিডিএস কোর্সে ভর্তি বিজ্ঞপ্তি:
                                    </div>
                                    <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                                </a>
                            </li>
                                                        <li class="animate-on-scroll animate__animated animate__fadeInDown" data-animation="fadeInDown" style="animation-delay: 0s;">
                                <a href="https://mdch.edu.bd/education/news/2022-2023-sikshabrshe-dental-klej-oo-medikel-klej-dental-iunitsmuuhe-bidies-korse-vrti-bijngpti-oo-smuuh-tarikh" class="hover-deep text-reset text-decoration-none text-nowrap">
                                    <div class="text-truncate mini-text">
                                        ২০২২-২০২৩ শিক্ষাবর্ষে ডেন্টাল কলেজ ও মেডিকেল কলেজ ডেন্টাল ইউনিটসমূহে বিডিএস কোর্সে ভর্তি বিজ্ঞপ্তি ও সমূহ তারিখ
                                    </div>
                                    <div class="text-end mb-2 text-muted"><small>25 July, 2023</small></div>
                                </a>
                            </li>
                                                    </ul>
                    </div>
                </div>
            </div>
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
