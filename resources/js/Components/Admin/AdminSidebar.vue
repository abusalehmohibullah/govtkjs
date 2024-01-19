<script setup>

// import { Head, Link, router } from '@inertiajs/vue3';
// import ApplicationLogo from '@/Components/ApplicationMark.vue';
// import { ref, watchEffect } from 'vue';
// import { usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
import SideNavLink from '@/Components/Shared/SideNavLink.vue';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const hasRolesAndPermissions = computed(() => page.props)

</script>

<template>
    <div class="simplebar-content" style="padding: 0px;">
        <a class="sidebar-brand" href="/">
            <span class="sidebar-brand-text align-middle">
                AdminKit
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <!-- dashboard -->
            <SideNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-sliders align-middle">
                    <line x1="4" y1="21" x2="4" y2="14"></line>
                    <line x1="4" y1="10" x2="4" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="3"></line>
                    <line x1="20" y1="21" x2="20" y2="16"></line>
                    <line x1="20" y1="12" x2="20" y2="3"></line>
                    <line x1="1" y1="14" x2="7" y2="14"></line>
                    <line x1="9" y1="8" x2="15" y2="8"></line>
                    <line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
                <span class="align-middle">Dashboard</span>
            </SideNavLink>

            <!-- basic-info -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_basic_infos'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_basic_infos'))"
                :href="route('admin.basic-info.show')" :active="route().current('admin.basic-info.show')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-layout align-middle">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
                <span class="align-middle">Basic Info</span>
            </SideNavLink>

            <!-- sliders  -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_sliders'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_sliders'))"
                :href="route('admin.sliders.index')" :active="route().current('admin.sliders.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-code align-middle me-2">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
                <span class="align-middle">Slider</span>
            </SideNavLink>

            <!-- notices  -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('clerk')
                || hasRolesAndPermissions.hasPermissions.includes('manage_notices'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('clerk')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_notices'))"
                :href="route('admin.notices.index')" :active="route().current('admin.notices.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-list align-middle me-2">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                </svg>
                <span class="align-middle">Notice</span>
            </SideNavLink>

            <!-- faqs -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_faqs'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_faqs'))"
                :href="route('admin.faqs.index')" :active="route().current('admin.faqs.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-help-circle align-middle me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="align-middle">FAQ</span>
            </SideNavLink>

            <!-- albums -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_albums'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_albums'))"
                :href="route('admin.albums.index')" :active="route().current('admin.albums.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-image align-middle me-2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span class="align-middle">Album</span>
            </SideNavLink>



            <Dropdown v-if="((hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_buildings'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_buildings')))
                || ((hasRolesAndPermissions.hasRoles.includes('operator')
                    || hasRolesAndPermissions.hasPermissions.includes('manage_rooms'))
                    &&
                    !(hasRolesAndPermissions.hasRoles.includes('operator')
                        && hasRolesAndPermissions.hasPermissions.includes('manage_rooms')))
                || ((hasRolesAndPermissions.hasRoles.includes('operator')
                    || hasRolesAndPermissions.hasPermissions.includes('manage_sections'))
                    &&
                    !(hasRolesAndPermissions.hasRoles.includes('operator')
                        && hasRolesAndPermissions.hasPermissions.includes('manage_sections')))
                || ((hasRolesAndPermissions.hasRoles.includes('operator')
                    || hasRolesAndPermissions.hasPermissions.includes('manage_grades'))
                    &&
                    !(hasRolesAndPermissions.hasRoles.includes('operator')
                        && hasRolesAndPermissions.hasPermissions.includes('manage_grades')))
                || ((hasRolesAndPermissions.hasRoles.includes('operator')
                    || hasRolesAndPermissions.hasPermissions.includes('manage_subjects'))
                    &&
                    !(hasRolesAndPermissions.hasRoles.includes('operator')
                        && hasRolesAndPermissions.hasPermissions.includes('manage_subjects')))
                || ((hasRolesAndPermissions.hasRoles.includes('operator')
                    || hasRolesAndPermissions.hasPermissions.includes('manage_groups'))
                    &&
                    !(hasRolesAndPermissions.hasRoles.includes('operator')
                        && hasRolesAndPermissions.hasPermissions.includes('manage_groups')))" align="right"
                width="100%" content-classes="relative z-50 bg-white">
                <template #trigger>
                    <span class="flex sidebar-item"
                        :class="(route().current('admin.buildings.*')) || (route().current('admin.rooms.*')) || (route().current('admin.sections.*')) || (route().current('admin.grades.*')) || (route().current('admin.subjects.*')) || (route().current('admin.groups.*')) ? 'active' : ''">
                        <button
                            class="inline-flex justify-between items-center sidebar-link w-full px-1 py-2 border border-transparent text-sm leading-4 font-medium hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            <div class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-grid align-middle me-2">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                Infrastructures
                            </div>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <div class="w-100 bg-gray-100">
                        <div class="block ps-8 pt-1 pb-0 text-xs text-gray-400 bg-white">
                            Step 1
                            <hr class="p-0 m-0">
                        </div>
                        <!-- branches -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_branches'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_branches'))"
                            :href="route('admin.branches.index')" :active="route().current('admin.branches.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Branches</span>
                        </SideNavLink>

                        <!-- buildings -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_buildings'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_buildings'))"
                            :href="route('admin.buildings.index')" :active="route().current('admin.buildings.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Building</span>
                        </SideNavLink>

                        <!-- rooms -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_rooms'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_rooms'))"
                            :href="route('admin.rooms.index')" :active="route().current('admin.rooms.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Room</span>
                        </SideNavLink>

                        <!-- sections -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_sections'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_sections'))"
                            :href="route('admin.sections.index')" :active="route().current('admin.sections.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Section</span>
                        </SideNavLink>

                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_subjects'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_subjects'))"
                            :href="route('admin.subjects.index')" :active="route().current('admin.subjects.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Subject</span>
                        </SideNavLink>

                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_groups'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_groups'))"
                            :href="route('admin.groups.index')" :active="route().current('admin.groups.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Group</span>
                        </SideNavLink>

                        <div class="block ps-8 pt-1 pb-0 text-xs text-gray-400 bg-white">
                            Step 2
                            <hr class="p-0 m-0">
                        </div>

                        <!-- grades -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_grades'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_grades'))"
                            :href="route('admin.grades.index')" :active="route().current('admin.grades.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Class</span>
                        </SideNavLink>

                        <!-- classrooms -->
                        <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                            || hasRolesAndPermissions.hasPermissions.includes('manage_classrooms'))
                            &&
                            !(hasRolesAndPermissions.hasRoles.includes('operator')
                                && hasRolesAndPermissions.hasPermissions.includes('manage_classrooms'))"
                            :href="route('admin.classrooms.index')" :active="route().current('admin.classrooms.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Classroom</span>
                        </SideNavLink>
                    </div>
                </template>
            </Dropdown>


            <Dropdown align="right" width="100%" content-classes="relative z-50 bg-white">
                <template #trigger>
                    <span class="flex sidebar-item"
                        :class="(route().current('admin.users.*')) || (route().current('admin.user-invitations.*')) ? 'active' : ''">
                        <button
                            class="inline-flex justify-between items-center sidebar-link w-full px-1 py-2 border border-transparent text-sm leading-4 font-medium hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            <div class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users align-middle me-2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Manage Users
                            </div>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <div class="w-100 bg-gray-100">
                        <SideNavLink :href="route('admin.users.index')" :active="route().current('admin.users.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Users</span>
                        </SideNavLink>

                        <SideNavLink :href="route('admin.user-invitations.index')"
                            :active="route().current('admin.user-invitations.*')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-chevron-right align-middle me-2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            <span class="align-middle">Invite Users</span>
                        </SideNavLink>
                    </div>
                </template>
            </Dropdown>


            <!-- students -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('teacher')
                || hasRolesAndPermissions.hasPermissions.includes('manage_students'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('teacher')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_students'))"
                :href="route('admin.students.index', { select_classroom: 'true' })" :active="route().current('admin.students.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-help-circle align-middle me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="align-middle">Students</span>
            </SideNavLink>

            <!-- teachers -->
            <SideNavLink v-if="(hasRolesAndPermissions.hasRoles.includes('operator')
                || hasRolesAndPermissions.hasPermissions.includes('manage_teachers'))
                &&
                !(hasRolesAndPermissions.hasRoles.includes('operator')
                    && hasRolesAndPermissions.hasPermissions.includes('manage_teachers'))"
                :href="route('admin.teachers.index')" :active="route().current('admin.teachers.*')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-help-circle align-middle me-2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="align-middle">Teachers</span>
            </SideNavLink>

        </ul>
    </div>
</template>

