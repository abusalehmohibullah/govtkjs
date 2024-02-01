  
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
import DeleteCalendarForm from '@/Pages/Admin/Calendars/Partials/DeleteCalendarForm.vue';


const props = defineProps({
    calendars: Object,
});

const showModal = ref(false);
const selectedCalendar = ref(null);

const toggleModal = (calendar) => {
    selectedCalendar.value = calendar;
    showModal.value = !showModal.value;
};

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'short' });
    const year = date.getFullYear();

    const dateFormatted = `${day} ${month}, ${year}`;
    return dateFormatted;
};

</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200">Event Type</th>
                <th class="py-2 px-4 border-b bg-slate-200">Event Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Details</th>
                <th class="py-2 px-4 border-b bg-slate-200">Event Date</th>
                <th class="py-2 px-4 border-b bg-slate-200">Class off?</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="calendars.data.length > 0" v-for="(calendar, index) in calendars.data" :key="index"
                class="hover:bg-blue-100" :class="calendar.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (calendars.current_page - 1) * calendars.per_page + index + 1
                }}</td>
                <td class="py-2 px-4 border-b text-center">{{ calendar.type }}</td>
                <td class="py-2 px-4 border-b text-center">{{ calendar.title }}</td>
                <td class="py-2 px-4 border-b text-center">{{ calendar.description }}</td>
                <td class="py-2 px-4 border-b text-center">{{ formatDate(calendar.start_date) }}<span
                        v-if="calendar.end_date"> - {{ formatDate(calendar.end_date) }}</span></td>
                <td class="py-2 px-4 border-b text-center">
                    <div class="rounded-2xl px-4 text-white" :class="calendar.class_off === 1 ? 'bg-blue-700' : 'bg-gray-500'">
                        {{ calendar.class_off === 1 ? 'Yes' : 'No' }}
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="calendar" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">

                        <ToggleStatus :toggle="calendar" :toggleType="`calendars`" />
                        <Link :href="route('admin.calendars.edit', calendar.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(calendar)">
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
    <DeleteCalendarForm :show="showModal" :calendar="selectedCalendar" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in calendars.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === calendars.links.length - 1">
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
                <template v-else-if="index === calendars.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



