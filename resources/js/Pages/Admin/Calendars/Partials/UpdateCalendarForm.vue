  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, reactive, computed, watch } from 'vue';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DateInput from '@/Components/DateInput.vue';
import Radio from '@/Components/Radio.vue';

const { calendar } = defineProps(['calendar']);

const form = useForm({
    _method: 'PUT',
    type: calendar.type,
    title: calendar.title,
    start_date: calendar.start_date,
    end_date: calendar.end_date,
    description: calendar.description,
    color: calendar.color,
    class_off: calendar.class_off,
});


const types = [
    { id: '#DC2626', name: 'Vacation' },
    { id: 'red', name: 'Public Holidays' },
    { id: 'green', name: 'Admissions' },
    { id: 'purple', name: 'Exams' },
    { id: 'orange', name: 'Results' },
    { id: 'yellow', name: 'Deadlines' },
    { id: 'pink', name: 'Parent-Teacher Meetings' },
    { id: 'cyan', name: 'Sports Events' },
    { id: 'brown', name: 'Cultural Events' },
    { id: 'indigo', name: 'Science Fair' },
    { id: 'teal', name: 'Library Events' },
    { id: 'gray', name: 'Other Events' }
];

const selectedType = ref({ id: '', name: '' });
const selectedTypeOption = types.find(type => type.name === calendar.type);
    if (selectedTypeOption) {
        selectedType.value = { id: selectedTypeOption.id, name: selectedTypeOption.name };
    } else {
        selectedType.value = { id: '', name: '' };
    }

watch(() => form.type, (newType, oldType) => {
    const selectedTypeOption = types.find(type => type.name === newType);
    if (selectedTypeOption) {
        selectedType.value = { id: selectedTypeOption.id, name: selectedTypeOption.name };
    } else {
        selectedType.value = { id: '', name: '' };
    }
});

const handleTypeSelected = (selectedLabel) => {
    const selectedId = selectedLabel; // Convert selected label to integer

    // Find the type by ID in English
    const selectedTypeOption = types.find(type => type.id === selectedId);
    if (selectedTypeOption) {
        form.type = selectedTypeOption.name; // Set English type name
        form.color = selectedTypeOption.id; // Set English type name
    }

    console.log(form.type);
};
const updateCalendar = () => {
    form.post(route('admin.calendars.update', calendar.id), {
        errorBag: 'updateCalendar',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="updateCalendar">
            <template #title>
                Add Evernts
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->
                <div class="flex">
                    <div class="col-span-6 sm:col-span-4 flex-grow">
                        <InputLabel for="type" value="Type of event">
                            <template #required>*</template>
                        </InputLabel>
                        <SelectInput :options="types" inputName="type" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedType" @option-selected="handleTypeSelected" />
                        <InputError :message="form.errors.type_id" class="text-red-500" />
                    </div>
                    <div class="col-span-5 sm:col-span-3 md:col-span-5 xl:col-span-3 ml-3">
                        <InputLabel for="class_off" value="Class off?" class="whitespace-nowrap">
                            <template #required>*</template>
                        </InputLabel>
                        <div class="flex flex-row">
                            <div class="form-check form-check-inline py-3">
                                <Radio id="inlineRadio1" v-model:checked="form.class_off" required
                                    class="mt-1 block form-check-input cursor-pointer"
                                    :class="{ 'border-red-500 focus:border-red-500': form.errors.class_off }" type="radio"
                                    name="class_off" value="1" />
                                <InputLabel class="form-check-label cursor-pointer" for="inlineRadio1" value="Yes" />
                            </div>
                            <div class="form-check form-check-inline py-3">
                                <Radio id="inlineRadio2" v-model:checked="form.class_off" required
                                    class="mt-1 block form-check-input cursor-pointer"
                                    :class="{ 'border-red-500 focus:border-red-500': form.errors.class_off }" type="radio"
                                    name="class_off" value="0" />
                                <InputLabel class="form-check-label cursor-pointer" for="inlineRadio2" value="No" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="title" value="Title">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="title" v-model="form.title" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.title }" type="text" name="title" />
                    <InputError :message="form.errors.title" class="text-red-500" />
                </div>

                <div class="col-span-6 sm:col-span-4 flex">
                    <div class="w-1/2">
                        <InputLabel for="start_date" value="Starts on">
                            <template #required>*</template>
                        </InputLabel>
                        <DateInput id="start_date" v-model="form.start_date" required class="mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.start_date }" type="date"
                            name="start_date" />
                        <InputError :message="form.errors.start_date" class="text-red-500" />
                    </div>
                    <div class="w-1/2">
                        <InputLabel for="end_date" value="Ends on">
                        </InputLabel>
                        <DateInput id="end_date" v-model="form.end_date" class="mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.end_date }" type="date"
                            name="end_date" />
                        <InputError :message="form.errors.end_date" class="text-red-500" />
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="description" value="Description">
                        <!-- <template #required>*</template> -->
                    </InputLabel>
                    <TextArea id="description" v-model="form.description" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.description }" type="text"
                        name="description" />
                    <InputError :message="form.errors.description" class="text-red-500" />
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="form.processing" class="mr-3"
                    :class="{ 'text-green-600': form.recentlySuccessful, ' text-gray-600': form.processing }">
                    {{ form.processing ? 'Creating...' : (form.recentlySuccessful ? 'Updated!' : 'Failed') }}
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update</PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>