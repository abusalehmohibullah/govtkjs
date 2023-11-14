  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import BuildingTable from '@/Pages/Admin/Buildings/Partials/BuildingTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { buildings } = defineProps(['buildings']);

</script>

<template>
    <AdminLayout title="Buildings">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Buildings
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.buildings.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <BuildingTable :buildings="buildings" />

        </div>

    </AdminLayout>
</template>

  