  
<script setup>

import { useForm } from '@inertiajs/vue3';

import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextArea from '@/Components/TextArea.vue';
const form = useForm({
    name: '',
    address: '',
    in_charge: '',
});

const createBranch = () => {
    form.post(route('admin.branches.store'), {
        errorBag: 'createBranch',
        preserveScroll: true,
    });
};

</script>

<template>
    <div>
        <!-- Use the Form component to wrap your form -->
        <FormSection @submitted="createBranch">
            <template #title>
                Add Branches
            </template>

            <template #description>
                Ensure your account is using a long, random password to stay secure.
            </template>

            <template #form>
                <!-- Use the Text Input component for each form field -->

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value="Branch Name">
                        <template #required>*</template>
                    </InputLabel>
                    <TextInput id="name" v-model="form.name" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.name }" type="text" name="name" />
                    <InputError :message="form.errors.name" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="address" value="Address" />
                    <TextArea id="address" v-model="form.address" class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.address }" name="address" />
                    <InputError :message="form.errors.address" class="text-red-500" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="in_charge" value="In-Charge" />
                    <TextInput id="in_charge" v-model="form.in_charge" required class="mt-1 block w-full"
                        :class="{ 'border-red-500 focus:border-red-500': form.errors.in_charge }" type="text" name="in_charge" />
                    <InputError :message="form.errors.in_charge" class="text-red-500" />
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