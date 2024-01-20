  
<script setup>

import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    priorities: Object,
});

const form = useForm({
    caption: '',
    path: '',
    priority: '',
});

const selectedPriority = ref({ id: '', name: '' });
const selectedPriorityOption = props.priorities[props.priorities.length - 1];

if (selectedPriorityOption) {
    selectedPriority.value = { id: selectedPriorityOption.id, name: selectedPriorityOption.name };
    form.priority = selectedPriorityOption.id;
} else {
    selectedPriority.value = { id: '', name: '' };
}

watch(() => form.priority, (newPriority, oldPriority) => {
    const selectedPriorityOption = props.priorities.find(priority => priority.id === newPriority);
    if (selectedPriorityOption) {
        selectedPriority.value = { id: selectedPriorityOption.id, name: selectedPriorityOption.name };
    } else {
        selectedPriority.value = { id: '', name: '' };
    }
});

const handlePrioritySelected = (selectedLabel) => {
    form.priority = selectedLabel;
};


const photoPreview = ref(null);

const previewPhoto = (event) => {
    const file = event.target.files[0];

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = (e) => {
            photoPreview.value = e.target.result;
        };

        reader.readAsDataURL(file);

        // Set the file to the form property
        form.photo = file;
    } else {
        // Clear the preview and reset the form property
        photoPreview.value = null;
        form.photo = null;
    }
};



const createSlider = () => {
    form.post(route('admin.sliders.store'), {
        errorBag: 'createSlider',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createSlider">
            <template #title>
                Add Slider
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->
                <div class="w-full flex justify-center items-center">
                    <div class="w-full aspect-video border shadow">
                        <img v-if="photoPreview" :src="photoPreview" alt="Photo Preview"
                            class="object-cover w-full aspect-video" />
                        <img v-else :src="'/assets/images/preview.png'" alt="Photo Preview"
                            class="object-contain w-full aspect-video" />
                    </div>
                </div>

                <div class="grid grid-cols-12 col-span-6 sm:col-span-4 gap-3 xl:gap-0">
                    <div class="col-span-12">
                        <InputLabel for="path" value="Image">
                            <template #required>*</template>
                        </InputLabel>
                        <FileInput @input="form.path = $event.target.files[0]" id="path" v-model="form.path"
                            class="form-control mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.path }" type="file"
                            accept="image/*" @change="previewPhoto" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="absolute h-[2px]">
                            {{ form.progress.percentage }}%
                        </progress>
                        <InputError :message="form.errors.path" class="text-red-500" />
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="caption" value="Caption">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="caption" v-model="form.caption" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.caption }" type="text"
                        name="caption" />
                    <InputError :message="form.errors.caption" class="text-red-500" />
                </div>


                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="priority" value="Select Order">
                        <template #required>*</template>
                    </InputLabel>
                    <SelectInput :options="priorities" inputName="priority" :fieldName="'name'" :valueField="'id'"
                        :selectedOption="selectedPriority" @option-selected="handlePrioritySelected" />

                    <InputError :message="form.errors.priority" class="text-red-500" />
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