  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    buildings: Object,
    grades: Object,
});

const form = useForm({
    building_id: '',
    room_id: '',
    grade_id: '',
    section_id: '',
    group_id: '',
});
// Define computed property for room options
const rooms = ref([]);
const roomsList = ref([]);

const handleBuildingChange = (selectedLabel) => {
    form.building_id = selectedLabel;
};

watch(() => form.building_id, (newValue, oldValue) => {
    // Update the rooms based on the new building selection
    const selectedBuilding = props.buildings.find(building => building.id == newValue);
    rooms.value = selectedBuilding ? selectedBuilding.rooms : [];
    console.log(rooms.value);
    roomsList.value = rooms.value.map(({ id, name, room_no }) => ({
        id,
        name: `${room_no} (${name})`
    }));
    form.room_id = '';
});

const handleRoomChange = (selectedLabel) => {
    form.room_id = selectedLabel;
};



const sections = ref([]);
const groups = ref([]);

const handleGradeChange = (selectedLabel) => {
    form.grade_id = selectedLabel;
};

watch(() => form.grade_id, (newValue, oldValue) => {
    // Update the rooms based on the new building selection
    const selectedGrade = props.grades.find(grade => grade.id == newValue);
    sections.value = selectedGrade ? selectedGrade.sections : [];
    groups.value = selectedGrade ? selectedGrade.groups : [];
    form.section_id = '';
    form.group_id = '';
});

const handleSectionChange = (selectedLabel) => {
    form.section_id = selectedLabel;
};

const handleGroupChange = (selectedLabel) => {
    form.group_id = selectedLabel;
};



const createClassroom = () => {
    form.post(route('admin.classrooms.store'), {
        errorBag: 'createClassroom',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createClassroom">
            <template #title>
                Add Classrooms
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->


                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="building" value="Building Name">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="buildings" inputName="building_id" :fieldName="'name'" :valueField="'id'"
                        v-model="form.building_id" @option-selected="handleBuildingChange" class="capitalize" />
                    <InputError :message="form.errors.building_id" class="text-red-500" />
                </div>

                <!-- Room Select Input -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="room" value="Room Name">
                        <template #required>*</template>
                    </InputLabel>
                    <!-- <dd>{{ reactiveOptions }}</dd> -->
                    <SelectInput :options="roomsList" inputName="room_id" :fieldName="'name'" :valueField="'id'"
                        v-model="form.room_id" @option-selected="handleRoomChange" class="capitalize" />
                    <InputError :message="form.errors.room_id" class="text-red-500" />
                </div>



                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="grade" value="Grade Name">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="grades" inputName="grade_id" :fieldName="'name'" :valueField="'id'"
                        v-model="form.grade_id" @option-selected="handleGradeChange" class="capitalize" />
                    <InputError :message="form.errors.grade_id" class="text-red-500" />
                </div>

                <!-- Section Select Input -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="section" value="Section Name">
                        <template #required>*</template>
                    </InputLabel>
                    <!-- <dd>{{ reactiveOptions }}</dd> -->
                    <SelectInput :options="sections" inputName="section_id" :fieldName="'name'" :valueField="'id'"
                        v-model="form.section_id" @option-selected="handleSectionChange" class="capitalize" />
                    <InputError :message="form.errors.section_id" class="text-red-500" />
                </div>

                <!-- Group Select Input -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="group" value="Group Name">
                        <template #required>*</template>
                    </InputLabel>
                    <!-- <dd>{{ reactiveOptions }}</dd> -->
                    <SelectInput :options="groups" inputName="group_id" :fieldName="'name'" :valueField="'id'"
                        v-model="form.group_id" @option-selected="handleGroupChange" class="capitalize" />
                    <InputError :message="form.errors.group_id" class="text-red-500" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Created!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>


