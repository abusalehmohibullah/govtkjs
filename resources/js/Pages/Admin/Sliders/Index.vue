  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import SliderTable from '@/Pages/Admin/Sliders/Partials/SliderTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { sliders } = defineProps(['sliders']);

</script>

<template>
    <AdminLayout title="Basic Info">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Sliders
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.sliders.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <SliderTable :sliders="sliders" />
            
            <!-- <template>
                <div>
                    <template v-for="link in sliders.links">
                        <Link v-if="link.url" :href="link.url">
                        <PrimaryButton v-if="link.active" v-html="link.label" />
                        <SecondaryButton v-else class="text-slate-600" v-html="link.label" />
                        </Link>
                        <SecondaryButton v-else v-html="link.label" class="opacity-50" />
                    </template>
                </div>
            </template> -->
        </div>

    </AdminLayout>
</template>

  