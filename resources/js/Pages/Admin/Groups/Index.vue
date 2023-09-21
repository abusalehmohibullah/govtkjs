  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import GroupTable from '@/Pages/Admin/Groups/Partials/GroupTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { groups } = defineProps(['groups']);

</script>

<template>
    <AdminLayout title="Groups">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Groups
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.groups.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <GroupTable :groups="groups" />

        </div>

    </AdminLayout>
</template>

  