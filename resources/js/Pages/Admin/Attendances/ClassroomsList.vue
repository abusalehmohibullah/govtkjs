  
<script setup>

import { Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

// import ClassroomTable from '@/Pages/Admin/Studens/Partials/ClassroomTable.vue';
import Header from '@/Components/Header.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from '@/Components/Pagination.vue';

const { classrooms } = defineProps(['classrooms']);

</script>

<template>
    <AdminLayout title="Basic Info">

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <Header>
                <template #header>
                    Attendances
                </template>
                <template #description>
                    Lorem ipsumuasi eniumquam error aspernatsuscipit.
                </template>
                <template #aside>
                    <Link :href="route('admin.classrooms.index')">
                    <PrimaryButton>
                        Manage Classrooms
                    </PrimaryButton>
                    </Link>
                </template>
            </Header>

            <!-- <ClassroomTable :classrooms="classrooms" /> -->

            <div class="mb-3 py-2 px-0 mx-0">

                <div
                    class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 2xl:grid-cols-5 parent-container">
                    <Link :href="route('admin.attendances.index', { selected_classroom: classroom.id})" v-if="classrooms.length > 0" v-for="(classroom, index) in classrooms" :key="index"
                        class="child-container mb-2 rounded-md">
                        <div class="d-flex align-items-center w-full rounded-md">
                            <div class="show-first-child card w-full">
                                <div class="w-full  rounded-md bg-white border shadow-sm position-relative">
                                    <div class="w-full ratio ratio-4x3 overflow-hidden rounded-t-md">
                                        <div class="flex justify-center items-center flex-col">
                                            <div class="text-3xl font-bold"><span>{{ classroom.grade.name }}</span>
                                            <span  v-if="classroom.section">({{ classroom.section.name }})</span></div>
                                            <div class="text-base" v-if="classroom.group">{{ classroom.group.name }}</div>
                                        </div>
                                            <!-- <img :src="album.path ? '/storage/' + album.path : '/assets/images/album-icon.png'"
                                            class="object-cover" /> -->

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </Link>


                </div>

            </div>

    </div>

</AdminLayout></template>

  