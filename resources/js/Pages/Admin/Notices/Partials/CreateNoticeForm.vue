  
<script setup>
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import DateInput from '@/Components/DateInput.vue';
import Radio from '@/Components/Radio.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    heading: '',
    title: '',
    content: '',
    published_on: getCurrentDate(),
    scroll: '',
    attachment: null,
});

const createNotice = () => {
    form.post(route('admin.notices.store'), {
        errorBag: 'createNotice',
        preserveScroll: true,
    });
};
function getCurrentDate() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

const enctype = 'multipart/form-data';

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createNotice">
            <template #title>
                Add Notice
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="heading" value="Heading">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="heading" v-model="form.heading" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.heading }" type="text" name="heading" />
                    <InputError :message="form.errors.heading" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="title" value="Title">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="title" v-model="form.title" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.title }" type="text" name="title" />
                    <InputError :message="form.errors.title" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="content" value="Content" />
                    <TextArea id="content" v-model="form.content" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.content }" name="content" />
                    <InputError :message="form.errors.content" class="text-red-500" />
                </div>
                <div class="grid grid-cols-12 col-span-6 sm:col-span-4 gap-3 xl:gap-0">
                    <div class="col-span-7 sm:col-span-4 md:col-span-7 xl:col-span-4">
                        <InputLabel for="published_on" value="Published On">
                            <template #required>*</template>
                        </InputLabel>
                        <DateInput id="published_on" v-model="form.published_on" required class="mt-1 block"
                            :class="{ 'border-red-500 focus:border-red-500': form.errors.published_on }" type="date"
                            name="published_on" />
                        <InputError :message="form.errors.published_on" class="text-red-500" />
                    </div>
                    <div class="col-span-5 sm:col-span-3 md:col-span-5 xl:col-span-3 ml-3">

                        <InputLabel for="scroll" value="Scroll?">
                            <template #required>*</template>
                        </InputLabel>
                        <div class="form-check form-check-inline py-3">
                            <Radio id="inlineRadio1" v-model:checked="form.scroll" required
                                class="mt-1 block form-check-input"
                                :class="{ 'border-red-500 focus:border-red-500': form.errors.scroll }" type="radio"
                                name="scroll" value="1" />
                            <InputLabel class="form-check-label" for="inlineRadio1" value="Yes" />
                        </div>
                        <div class="form-check form-check-inline py-3">
                            <Radio id="inlineRadio2" v-model:checked="form.scroll" required
                                class="mt-1 block form-check-input"
                                :class="{ 'border-red-500 focus:border-red-500': form.errors.scroll }" type="radio"
                                name="scroll" value="0" />
                            <InputLabel class="form-check-label" for="inlineRadio2" value="No" />
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-5 md:col-span-12 xl:col-span-5">
                        <InputLabel for="attachment" value="Attachment" />
                        <FileInput @input="form.attachment = $event.target.files[0]" id="attachment"
                        v-model="form.attachment" class="form-control mt-1 block"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.attachment }" type="file" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100" class="absolute h-[2px]">
                            {{ form.progress.percentage }}%
                        </progress>
                        <InputError :message="form.errors.attachment" class="text-red-500" />
                    </div>
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