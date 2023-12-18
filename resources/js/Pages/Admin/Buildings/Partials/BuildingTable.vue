  
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
import DeleteBuildingForm from '@/Pages/Admin/Buildings/Partials/DeleteBuildingForm.vue';


const props = defineProps({
    buildings: Object,
});

const showModal = ref(false);
const selectedBuilding = ref(null);

const toggleModal = (building) => {
    selectedBuilding.value = building;
    showModal.value = !showModal.value;
};


</script>

<template>
    <Table>
        <template #thead>
            <tr>
                <th class="py-2 px-4 border-b bg-slate-200">#</th>
                <th class="py-2 px-4 border-b bg-slate-200 whitespace-nowrap">Building Name</th>
                <th class="py-2 px-4 border-b bg-slate-200">Room Nos</th>
                <th class="py-2 px-4 border-b bg-slate-200">Created/Edited</th>
                <th class="py-2 px-4 border-b bg-slate-200">Action</th>
            </tr>
        </template>
        <template #tbody>


            <tr v-if="buildings.data.length > 0" v-for="(building, index) in buildings.data" :key="index"
                class="hover:bg-blue-100" :class="building.status === 0 ? 'bg-gray-200 opacity-70' : ''">
                <td class="py-2 px-4 border-b text-center">{{ (buildings.current_page - 1) * buildings.per_page + index + 1
                }}</td>
                <td class="py-2 px-4 border-b text-center">{{ building.name }}</td>
                <td class="py-2 px-4 border-b text-center w-full">
                    <div v-if="building.rooms.length > 0" class="flex flex-wrap gap-1">
                        <div v-for="room in building.rooms" :key="room"
                            class="text-white rounded-full px-2 py-1 text-xs" :class="room.status != 1 ? 'bg-gray-400' : 'bg-gray-700'">{{ room.room_no}}</div>
                    </div>
                    <div v-else>No Room found</div>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <CreatedUpdatedBy :createdUpdatedBy="building" />
                </td>
                <td class="py-2 px-4 border-b">
                    <div class="flex justify-center">

                        <ToggleStatus :toggle="building" :toggleType="`buildings`" />
                        <Link :href="route('admin.buildings.edit', building.id)">
                        <PrimaryIconButton>
                            <i class="fas fa-pen"></i>
                        </PrimaryIconButton>
                        </Link>

                        <!-- Delete button -->
                        <DangerIconButton class="ml-1" @click="() => toggleModal(building)">
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
    <DeleteBuildingForm :show="showModal" :building="selectedBuilding" @close="toggleModal" />
    <div class="mt-5">
        <template v-for="(link, index) in buildings.links">
            <template v-if="link.url">
                <Link :href="link.url">
                <template v-if="link.active">
                    <PrimaryPaginatorButton v-html="link.label" />
                </template>
                <template v-else>
                    <template v-if="index === 0">
                        <SecondaryPaginatorButton v-html="link.label.split(' ')[0].trim()" />
                    </template>
                    <template v-else-if="index === buildings.links.length - 1">
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
                <template v-else-if="index === buildings.links.length - 1">
                    <SecondaryPaginatorButton v-html="link.label.split(' ')[1].trim()" class='opacity-40' />
                </template>
                <template v-else>
                    <SecondaryPaginatorButton v-html="link.label" />
                </template>
            </template>
        </template>

    </div>
</template>



