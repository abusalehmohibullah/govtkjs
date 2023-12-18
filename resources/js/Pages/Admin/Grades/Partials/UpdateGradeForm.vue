  
<script setup>
import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Section from '@/Components/Admin/Section.vue';
import Group from '@/Components/Admin/Group.vue';
import Subject from '@/Components/Admin/Subject.vue';

const props = defineProps({
    grade: Object,
    sections: Object,
    selectedSection: Object,
    groups: Object,
    selectedGroup: Object,
    subjects: Object,
    selectedSubject: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.grade.name,
    selectedSections: [],
    selectedGroups: [],
    selectedSubjects: [],
});

const handleSelectedSectionsUpdated = (newSelectedSections) => {
    // console.log('Selected sections Updated:', newSelectedSections);
    form.selectedSections = newSelectedSections;
};

const handleSelectedGroupsUpdated = (newSelectedGroups) => {
    // console.log('Selected groups Updated:', newSelectedGroups);
    form.selectedGroups = newSelectedGroups;
};

const handleSelectedSubjectsUpdated = (newSelectedSubjects) => {
    // console.log('Selected subjects Updated:', newSelectedSubjects);
    form.selectedSubjects = newSelectedSubjects;
};

const updateGrade = () => {
    form.post(route('admin.grades.update', props.grade.id), {
        errorBag: 'updateGrade',
        preserveScroll: true,
    });
};
</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateGrade">
            <template #title>
                Edit Class
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Class Name">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="name" v-model="form.name" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.name }" type="number" name="name" />
                    <InputError :message="form.errors.name" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <Section :data="sections" :selectedData="selectedSection" @selected-items-updated="handleSelectedSectionsUpdated" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <Group :data="groups" :selectedData="selectedGroup" @selected-items-updated="handleSelectedGroupsUpdated" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <Subject :data="subjects" :selectedData="selectedSubject" @selected-items-updated="handleSelectedSubjectsUpdated" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Saving...' : (form.recentlySuccessful ? 'Saved!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>