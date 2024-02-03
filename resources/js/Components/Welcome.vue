<script setup>
import { Link } from '@inertiajs/vue3';

const { classrooms } = defineProps(['classrooms']);
</script>

<template>
    <div class="container-fluid p-6">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto">
                <div class="uppercase text-lg sm:text-2xl font-bold">Welcome {{ $page.props.auth.user.name }}!</div>
            </div>
            <!-- 
            <div class="col-auto ms-auto text-end mt-n1">
                <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
                <a href="#" class="btn btn-primary">New Project</a>
            </div> -->
        </div>
        <div class="row">
            <div v-if="classrooms && classrooms.length > 0" class="text-lg font-semibold">Manage your Class</div>
            <div v-if="classrooms"
                class="grid grid-cols-3 grid-rows-1 gap-2 sm:grid-cols-4 sm:grid-rows-1 sm:gap-4 2xl:grid-cols-5 parent-container">
                    <Link :href="route('admin.students.index', { selected_classroom: classroom.id})" v-if="classrooms.length > 0" v-for="(classroom, index) in classrooms" :key="index"
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
</template>
