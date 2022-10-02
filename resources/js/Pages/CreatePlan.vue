<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import axios from 'axios';
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

    const form = useForm({
        name: '',
        is_default: false
    });

    const submit = () => {
        axios.get('/sanctum/csrf-cookie').then(response => {
            form.post(route('api.plans.store'));
        });
    };

</script>

<template>
    <div>

    <Head title="Create plan" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a plan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <BreezeValidationErrors class="mb-4" />
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="name" value="Plan Name" />
                            <BreezeInput id="name" type="text" class="mt-1 block w-full md:w-1/2" v-model="form.name" required autofocus />
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <BreezeCheckbox name="is_default" v-model:checked="form.is_default" />
                                <span class="ml-2 text-sm text-gray-600">Set as default</span>
                            </label>
                        </div>

                        <div class="items-center justify-start mt-4">
                            <button type="submit" class="w-full md:w-1/2 bg-black text-white rounded p-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</div>
    </template>
