  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import GradeTable from '@/Pages/Admin/Grades/Partials/GradeTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const { grades } = defineProps(['grades']);

</script>

<template>
    <AdminLayout title="Grades">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Grades
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.grades.create')">
                    <PrimaryButton>
                        Create
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <GradeTable :grades="grades" />

        </div>

    </AdminLayout>
</template>

  