  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import ClassroomTable from '@/Pages/Admin/Classrooms/Partials/ClassroomTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { classrooms } = defineProps(['classrooms']);

</script>

<template>
    <AdminLayout title="Classrooms">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Classrooms
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.classrooms.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <ClassroomTable :classrooms="classrooms" />

        </div>

    </AdminLayout>
</template>

  