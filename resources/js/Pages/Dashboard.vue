<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';

</script>

<template>
    <div>
        <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-x-auto relative">

                            <div class="pb-4 bg-white dark:bg-gray-900">
                                <label for="table-search" class="sr-only">Search</label>
                                <!-- <div class="relative mt-1 flex">
                                    <div>
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                                    </div>

                                </div> -->

                            <div class="flex">
                                    <Link :href="route('create-plan')" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-5 mt-5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Create new meal plan
                                    </Link>

                                    <!-- <button v-if="false" type="button" class="text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-10 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 ">See all meal plans</button> -->
                                    <Link :href="route('create-schedule')" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-5 mt-5 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 ">Create new plan schedule</Link>
                            </div>

                            </div>
                            <p class="ml-5">Active Plan: {{activePlan? activePlan.name: null}}</p>
                            <div class="flex w-100">
                                <div class="p-5 w-full text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                    Meals planned for today
                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Here are your meals for today.</p>

                                <dl class="mt-5 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                    <div class="flex flex-col pb-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                           Breakfast
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansToday.breakfast?.meal_name}}
                                        </dd>
                                    </div>
                                    <div class="flex flex-col py-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                            Lunch
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansToday.lunch?.meal_name}}
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                            Dinner
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansToday.dinner?.meal_name}}
                                        </dd>
                                    </div>
                                </dl>

                                </div>
                                <div class="p-5 w-full text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                    Meals planned for tomorrow
                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Here are your meals for tomorrow.</p>

                                <dl class="mt-5 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                                    <div class="flex flex-col pb-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                           Breakfast
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansTomorrow.breakfast ?plansTomorrow.breakfast.meal_name: null}}
                                        </dd>
                                    </div>
                                    <div class="flex flex-col py-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                            Lunch
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansTomorrow.lunch?plansTomorrow.lunch.meal_name:null}}
                                        </dd>
                                    </div>
                                    <div class="flex flex-col pt-3">
                                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                            Dinner
                                        </dt>
                                        <dd class="text-md font-semibold">
                                            {{plansTomorrow.dinner?plansTomorrow.dinner.meal_name:null}}
                                        </dd>
                                    </div>
                                </dl>

                            </div>
                            </div>

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                                <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                    Meals for the week
                                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse your list of meals for the week, this is based on the meal plan you have selected as the default.</p>
                                </caption>

                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            Weekday
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Meal Type
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Meal Name
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Created By
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="plan in plans" :key="plan.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{plan.weekday.name}}
                                        </th>
                                        <td class="py-4 px-6">
                                            {{plan.meal_type.name}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{plan.meal_name}}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{plan.created_by}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userData: [],
                plans: [],
                plansToday: {},
                plansTomorrow: {},
                activePlan: {}
            }
        },
        created() {
            this.fetchMealSchedules()
            this.fetchTodayPlans()
            this.fetchTomorrowPlans()
            this.getActivePlan()
        },
        methods: {
            fetchMealSchedules() {
                axios.get(route('api.plans')).then(data => {
                    this.plans = data.data.data
                })
            },
            fetchTodayPlans() {
                axios.get(route('api.plans.today')).then(data => {
                    this.plansToday = data.data.data
                })
            },
            fetchTomorrowPlans() {
                axios.get(route('api.plans.tomorrow')).then(data => {
                    this.plansTomorrow = data.data.data
                })
            },
            getActivePlan() {
                axios.get(route('api.plans.active')).then(data => {
                    this.activePlan = data.data.data
                })
            }
        }
    }
</script>
