  
<script setup>
import { ref, reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import Table from '@/Components/Table.vue';
import CreatedUpdatedBy from '@/Components/Admin/CreatedUpdatedBy.vue';
import ToggleStatus from '@/Components/Admin/ToggleStatus.vue';
import PrimaryPaginatorButton from '@/Components/PrimaryPaginatorButton.vue';
import SecondaryPaginatorButton from '@/Components/SecondaryPaginatorButton.vue';
import PrimaryIconButton from '@/Components/PrimaryIconButton.vue';
import DangerIconButton from '@/Components/DangerIconButton.vue';
import DeleteGradeForm from '@/Pages/Admin/Grades/Partials/DeleteGradeForm.vue';


const props = defineProps({
    grades: Object,
});

const showModal = ref(false);
const selectedGrade = ref(null);

const toggleModal = (grade) => {
    selectedGrade.value = grade;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Classes</th>
                <th class="py-2 px-4 border-b bg-slate-200">Sections</th>
                <th class="py-2 px-4 border-b bg-slate-200">Groups</th>
                <th class="py-2 px-4 border-b bg-slate-200">Subjects</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="grades.data.length > 0" v-for="(grade, index) in grades.data" :key="index" class="hover:bg-blue-100"
                :class="grade.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (grades.current_page - 1) * grades.per_page + index + 1 }}
                </td>
                <td class="py-2 px-4 border-b text-center">{{ grade.name }}</td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="grade.sections.length > 0" class="flex flex-wrap justify-center gap-1">
                        <div v-for="section in grade.sections" :key="section"
                            class="text-white rounded-full px-2 py-1 text-xs" :class="section.status != 1 ? 'bg-gray-400' : 'bg-gray-700'">{{ section.name}}</div>
                    </div>
                    <div v-else>No Section found</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="grade.groups.length > 0" class="flex flex-wrap justify-center gap-1">
                        <div v-for="group in grade.groups" :key="group"
                            class="text-white rounded-full px-2 py-1 text-xs" :class="group.status != 1 ? 'bg-gray-400' : 'bg-gray-700'">{{ group.name}}</div>
                    </div>
                    <div v-else>No Group found</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <div v-if="grade.subjects.length > 0" class="flex flex-wrap justify-center gap-1">
                        <div v-for="subject in grade.subjects" :key="subject"
                            class="text-white rounded-full px-2 py-1 text-xs whitespace-nowrap" :class="subject.status != 1 ? 'bg-gray-400' : 'bg-gray-700'">{{ subject.code + '-' + subject.name}}</div>
                    </div>
                    <div v-else>No Subject found</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="grade" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">

                        <ToggleStatus :toggle="grade" :toggleType="`grades`" />
                        <Link :href="route('admin.grades.edit', grade.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(grade)">
                            <i class="fas fa-trash"></i>
                        </DangerIconButton>

                    </div>
                </td>
            </tr>

            <tr v-else>
                <td colspan="3" class="text-center p-3">
                    Not Data Found
                </td>
            </tr>
        </template>
    </Table>
    <!-- Modal form outside the table -->
    <DeleteGradeForm :show="showModal" :grade="selectedGrade" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in grades.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === grades.links.length - 1">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" />
                    </template>
                    <template v-else>
                        <SecondaryPaginatorButton v-html="link.label" />
                    </template>
                </template>
                </Link>
            </template>
            <template v-else>
                <template v-if="index === 0">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" class='opacity-40' />
                </template>
                <template v-else-if="index === grades.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



