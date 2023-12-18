  
<script setup>

import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    buildings: Object,
    sections: Object,
    grades: Object,
});

const form = useForm({
    classroom_no: '',
    building_id: '',
    name: '',
    student_capacity: '',
    examinee_capacity: '',
});

const handleOptionSelected = (selectedLabel) => {
    form.building_id = selectedLabel; // Update albumName ref
    // console.log('gg');
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
                    <SelectInput :options="buildings" inputName="building" :fieldName="'name'" :valueField="'id'"
                        @option-selected="handleOptionSelected" class="capitalize" />

                    <InputError :message="form.errors.room_id" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="section" value="Section Name">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="sections" inputName="section" :fieldName="'name'" :valueField="'id'"
                        @option-selected="handleOptionSelected" class="capitalize" />

                    <InputError :message="form.errors.section_id" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="grade" value="Class Name">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="grades" inputName="grade" :fieldName="'name'" :valueField="'id'"
                        @option-selected="handleOptionSelected" class="capitalize" />

                    <InputError :message="form.errors.grade_id" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="classroom_no" value="Classroom No">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="classroom_no" v-model="form.classroom_no" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.classroom_no }" type="number"
                        name="classroom_no" />
                    <InputError :message="form.errors.classroom_no" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Classroom Name">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <TextInput id="name" v-model="form.name" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.name }" type="text" name="name" />
                    <InputError :message="form.errors.name" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="student_capacity" value="Student Capacity">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <TextInput id="student_capacity" v-model="form.student_capacity" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.student_capacity }" type="number"
                        name="student_capacity" />
                    <InputError :message="form.errors.student_capacity" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="examinee_capacity" value="Examinee Capacity">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <TextInput id="examinee_capacity" v-model="form.examinee_capacity" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.examinee_capacity }" type="number"
                        name="examinee_capacity" />
                    <InputError :message="form.errors.examinee_capacity" class="text-red-500" />
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