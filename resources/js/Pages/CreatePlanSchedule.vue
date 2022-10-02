<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeCheckbox from '@/Components/Checkbox.vue';
    import BreezeInput from '@/Components/Input.vue';
    import BreezeLabel from '@/Components/Label.vue';
    import axios from 'axios';
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

    const form = useForm({
        meal_name: '',
        weekday: '',
        meal_type: '',
        plan: ''
    });

    const submit = () => {
        axios.get('/sanctum/csrf-cookie').then(response => {
            form.post(route('api.schedule.store'));
        });
    };

    defineProps({
        weekdays: {
            type: Array,
            default: [],
        },
        meal_types: {
            type: Array,
            default: [],
        },
        plans: {
            type: Array,
            default: [],
        }
    });

</script>

<template>
    <div>

    <Head title="Create plan" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a plan schedule
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                    <BreezeValidationErrors class="mb-4" />
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="meal_name" value="Meal Name" />
                            <BreezeInput id="meal_name" name="meal_name" type="text" class="mt-1 block w-full md:w-1/2" v-model="form.meal_name" required autofocus />
                        </div>

                        <div class="block mt-4">
                            <label for="weekdays" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Weekday</label>
                            <select v-model="form.weekday" id="weekdays" name="weekday" class="border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a weekday</option>
                            <option v-for="weekday in weekdays" :value="weekday.id">
                                {{weekday.name}}
                            </option>
                            </select>
                        </div>

                        <div class="block mt-4">
                            <label for="meal-types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Meal type</label>
                            <select v-model="form.meal_type" id="meal-types" name="meal-type" class="border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a meal type</option>
                            <option v-for="mealType in meal_types" :value="mealType.id">
                                {{mealType.name}}
                            </option>
                            </select>
                        </div>

                        <div class="block mt-4">
                            <label for="plans" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Plan</label>
                            <select v-model="form.plan" id="plans" name="plan" class="border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full md:w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose a plan</option>
                            <option v-for="plan in plans" :value="plan.id">
                                {{plan.name}}
                            </option>
                            </select>
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
